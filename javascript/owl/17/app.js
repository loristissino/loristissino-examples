const { Component, mount, xml, useState, reactive, onRendered, useRef } = owl;

// App common function

const appLocalStoragePrefix = "MyApp_";

function useStoredState(key, initialState) {
      key = appLocalStoragePrefix + key;
      const state = JSON.parse(localStorage.getItem(key)) || initialState;
      const store = (obj) => localStorage.setItem(key, JSON.stringify(obj));
      const reactiveState = reactive(state, () => store(reactiveState));
      store(reactiveState);
      return useState(state);
    }

// Owl Components

class Person extends Component {
    static template = "Person";
    static props = ["name", "id", "clickCounter", "onClick"]; 
    idRef = useRef("id");
    
    setup() {
        onRendered(()=>{
            console.log(`updated view ${this.props.name} with ${this.props.clickCounter.value}`);
        });
    }

    increaseClickCounter(ev) {
        this.props.onClick(ev.target.parentElement.id);
        this.idRef.el.classList.add('highlighted');
        setTimeout(()=>{this.idRef.el.classList.remove('highlighted');}, 500);
    }
    
    get counter() {
        return this.props.clickCounter.lastClick ? this.props.clickCounter.value : '';
    }
        
}

class Root extends Component {
    static template = "Hello";
    static components = { Person };
    lastClickedRef = useRef("lastClicked");

    cities = [ 'Rome', 'New York', 'Tallinn', 'Paris'];
    
    setup() {
        this.people = useStoredState('people.state', 
            [
                {id: 1, name: 'Alice', clickCounter: {value: 0, lastClick: null}},
                {id: 2, name: 'Bob', clickCounter: {value: 0, lastClick: null}},
                {id: 3, name: 'Charlie', clickCounter: {value: 0, lastClick: null}},
                {id: 4, name: 'Donna', clickCounter: {value: 0, lastClick: null}},
            ]        
        );
    }

    nameClicked(id) {
        const index = this.people.findIndex(p => p.id == id);
        this.people[index].clickCounter.value++;
        this.people[index].clickCounter.lastClick = Date.now();
        this.lastClickedRef.el.innerHTML = this.people[index].name;
    }
  
}


(async function() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
    console.log("hello owl", owl.__info__.version);
})();
