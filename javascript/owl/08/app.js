const { Component, mount, xml } = owl;

// Owl Components

class Person extends Component {
    static template = "Person";
    static props = ["name"];

    doSomething(ev) {
        console.log("clicked", ev.target);
        alert(`clicked on ${ev.target.innerHTML}`);
    }
    
}

class Root extends Component {
    static template = "Hello";
    static components = { Person };

    people = [
        {id: 1, name: 'Alice'},
        {id: 2, name: 'Bob'},
        {id: 3, name: 'Charlie'},
        {id: 4, name: 'Donna'},
    ];

    // we may have a list of cities or not... the template will take care of that
    cities = [ 'Rome', 'New York', 'Tallinn', 'Paris'];
  
}


(async function() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
    console.log("hello owl", owl.__info__.version);
})();
