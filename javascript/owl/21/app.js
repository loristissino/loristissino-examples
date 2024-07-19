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
    static components = { Account };
    newAccountRef = useRef('newAccount');
    
    setup() {
        this.accounts = useStoredState('accounts.state', 
            [
                {id: 1, name: 'Alice', amount: 100},
                {id: 2, name: 'Bob', amount: 0},
                {id: 3, name: 'Charlie', amount: 150},
                {id: 4, name: 'Donna', amount: 300},
            ]        
        );
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
  
}


(async function() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
    console.log("hello owl", owl.__info__.version);
})();
