const { Component, mount, xml, useState, reactive, onRendered, useRef } = owl;

// App common function

const appLocalStoragePrefix = "OwlTranfers_";

function useStoredState(key, initialState) {
      key = appLocalStoragePrefix + key;
      const state = JSON.parse(localStorage.getItem(key)) || initialState;
      const store = (obj) => localStorage.setItem(key, JSON.stringify(obj));
      const reactiveState = reactive(state, () => store(reactiveState));
      store(reactiveState);
      return useState(state);
    }

// Owl Components

class SelectionBox extends Component {
    static template = "SelectionBox";
    static props = ["id", "label", "values" ];
}

class Account extends Component {
    static template = "Account";
    static props = ["account", "onDelete", "onChange"]; 
    idRef = useRef("id");
    
    setup() {
        onRendered(()=>{
            //console.log(`updated view ${this.props.account.name}`);
        });
    }
    
    deleteAccount(ev) {
        this.props.onDelete(ev.target.parentElement.id);
    }
    
    rename(ev) {
        let newname = ev.target.innerHTML.trim().replaceAll(/\<br\>/g, '');
        this.props.onChange(ev.target.parentElement.id, newname);
    }
    
    get isDeletable() {
        return this.props.account.amount == 0;
    }
}

class Root extends Component {
    static template = "Transfers";
    static components = { Account, SelectionBox };
    newAccountRef = useRef('newAccount');
    amountRef = useRef('amount');
    // The useRef hook cannot be used to get a reference to an instance of a sub component
    // so we cannot use it to refer to a the selection box
    
    messageRef = useRef('message');
    
    setup() {
        this.accounts = useStoredState('accounts.state', 
            [
                {id: 1, name: 'Alice', amount: 100},
                {id: 2, name: 'Bob', amount: 0},
                {id: 3, name: 'Charlie', amount: 150},
                {id: 4, name: 'Donna', amount: 300},
            ]        
        );

        this.remoteStore = useStoredState('remotestore.state', {
            url: '',
            id: '',
        });
        
        this.amountState = useState({ amountOK: false} );
        this.dirty = useState({lastUpdate: false});
    }

    deleteAccount(id) {
        const index = this.accounts.findIndex(p => p.id == id);
        if (this.accounts[index].amount == 0) {
            this.accounts.splice(index, 1);
            this.dirty.lastUpdate = Date.now();
        }
    }
    
    changeName(id, name) {
        const index = this.accounts.findIndex(p => p.id == id);
        if (name) {
            this.accounts[index].name=name;
            this.dirty.lastUpdate = Date.now();
        }
    }
    
    newAccount_keypress(ev) {
        // if ENTER has been pressed...
        if (ev.key === 'Enter') {
            this.addAccount();
        }
    }
    
    newAccount_click() {
        this.addAccount();
    }
    
    addAccount() {
        let name = this.newAccountRef.el.value.trim();
        if (name) {
            const maxIndex = Math.max(...this.accounts.map(p=>p.id), 0);
            let account = {id: maxIndex+1, name: name, amount: 0};
            let parts = name.split(':');
            if (parts.length>1) {
                console.log(parts);
                account.name = parts[0].trim();
                account.amount = parseInt(parts[1].trim());
                if (!Number.isFinite(account.amount)) {
                    account.amount = 0;
                }
            }
            this.accounts.push(account);
        }
        this.newAccountRef.el.value = '';
        this.newAccountRef.el.focus();
        this.dirty.lastUpdate = Date.now();
    }
    
    transfer_click() {
        return transfer();
    }
    
    amount_keyup(ev) {
        if (ev.key === 'Enter') {
            return this.transfer();
        }
        this.amountState.amountOK = this.amountRef.el.value > 0;
    }
    
    transfer() {
        let amount = parseInt(this.amountRef.el.value);
        let sourceIndex = this.accounts.findIndex(p => p.id == document.querySelector('#sourceAccountId').value);
        let targetIndex = this.accounts.findIndex(p => p.id == document.querySelector('#targetAccountId').value);
        if (sourceIndex==-1 || targetIndex==-1) {
            return this.showMessage('Wrong accounts', 'error');
        }
        if (!amount || amount<=0) {
            if (!amount) amount=0;
            return this.showMessage(`It is not possible to transfer the required amount of € ${amount}.`, 'error');
        }
        if (sourceIndex == targetIndex) {
            return this.showMessage(`Source and target are the same account.`, 'error');
        }
        if (this.accounts[sourceIndex].amount < amount) {
            return this.showMessage(`Not enough money in the source account to transfer € ${amount}.`, 'error');
        }
        // everything ok
        this.accounts[sourceIndex].amount -= amount;
        this.accounts[targetIndex].amount += amount;
        this.dirty.lastUpdate = Date.now();
        this.showMessage(`The amount (€ ${amount}) has been successfully transferred.`);
    }
    
    showMessage(message, type='success') {
        this.messageRef.el.innerHTML = message;
        if (type=='error') {
            this.messageRef.el.classList.add('error');
        }
        else {
            this.messageRef.el.classList.remove('error');
        }
    }
        
    async save() {
        if (!this.remoteStore.url) {
            this.remoteStore.url = prompt('URL of the remote store');
        }
        try {
            let response = await fetch(this.remoteStore.url, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify(this.accounts)
            });
            if (response.ok) {
                let result = await response.json();
                this.remoteStore.id = result.id;
                this.showMessage(`Saved with id ${this.remoteStore.id}.`);
                this.dirty.lastUpdate = false;
            }
            else {
                this.showMessage(`Not saved.`, 'error');
            }
        }
        catch (exception) {
            console.log(exception);
        }
    }
    
    async load() {
        if (!this.remoteStore.url) {
            this.remoteStore.url = prompt('URL of the remote store');
        }
        if (!this.remoteStore.id) {
            this.remoteStore.id = prompt('ID of the resource');
        }
        try {
            let response = await fetch(this.remoteStore.url + '?id=' + this.remoteStore.id, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            });
            if (response.ok) {
                let result = await response.json();
                this.accounts.length = 0;  // a quick way to remove all the data from the array
                result.forEach((account) => {this.accounts.push(account);});
                this.dirty.lastUpdate = false;
                this.showMessage(`Data with id ${this.remoteStore.id} loaded.`);
            }
            else {
                this.unregister();
                this.showMessage(`Not loaded.`, 'error');
            }
        }
        catch (exception) {
            console.log(exception);
        }
    }
    
    unregister() {
        this.remoteStore.url = '';
        this.remoteStore.id = '';
    }
  
}


(async function() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
    console.log("hello owl", owl.__info__.version);
})();
