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
    static props = ["account", "onDelete" ]; 
    idRef = useRef("id");
    
    setup() {
        onRendered(()=>{
            //console.log(`updated view ${this.props.account.name}`);
        });
    }
    
    deleteAccount(ev) {
        this.props.onDelete(ev.target.parentElement.id);
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
        this.amountState = useState({ amountOK: false} );
    }

    deleteAccount(id) {
        const index = this.accounts.findIndex(p => p.id == id);
        if (this.accounts[index].amount == 0) {
            this.accounts.splice(index, 1);
        }
    }
    
    addAccount(ev) {
        // if ENTER has been pressed...
        if (ev.keyCode === 13) {
            const maxIndex = Math.max(...this.accounts.map(p=>p.id), 0);
            let name = this.newAccountRef.el.value.trim();
            if (name) {
                this.accounts.push({id: maxIndex+1, name: name, amount: 0});
            }
            this.newAccountRef.el.value = '';
            this.newAccountRef.el.focus();
        }
    }
    
    transfer(ev) {
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
    
    evaluateAmount() {
        this.amountState.amountOK = this.amountRef.el.value > 0;
    }
  
}


(async function() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
    console.log("hello owl", owl.__info__.version);
})();
