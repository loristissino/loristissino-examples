class Animal {
    #id = 0;  // private field
    name;     // public field
    
    constructor(id, name="Unknown pet"){ // constructor, with default value for one parameter
        this.#id = id;
        this.name = name;
    }
    
    greet() {
        console.log(`Hello, I am the animal with Id ${this.#id}.`);
        return this;
    }

    speak() {
        console.log(`Noise from «${this.name}».`);
        return this;
    }

    get id() {  // getter
        return this.#id;
    }

    set id(value) {  // setter
        if (value>0) {
            this.#id = value;
        }
    }

    toString() {
        return `Animal ${this.name}, id: ${this.id}`;
    }
    
}

class Dog extends Animal {
    speak() {
        console.log(`Woof from «${this.name}».`);
        return this;
    }
    toString() {
        return `Dog ${this.name}, id: ${this.id}`;
    }
}

const a = new Animal(6);
a.greet().speak();
a.id = 23;
console.log(a);


const d = new Dog(7, "Snoopy");
d.greet().speak();
console.log(d);

