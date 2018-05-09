package it.tissino.people;

import java.util.StringTokenizer;

public class PersonBuilder {
    Person p;

    public PersonBuilder create() {
        p = new Person();
        age(18);
        return this;
    }

    public PersonBuilder fromString(String s)
    {
        StringTokenizer st = new StringTokenizer(s, "\t");

        // TODO: use try... catch to handle errors...
        id(Integer.parseInt(st.nextToken()));
        firstName(st.nextToken());
        lastName(st.nextToken());
        age(Integer.parseInt(st.nextToken()));

        return this;
    }

    PersonBuilder firstName(String v) {
        p.setFirstName(v);
        return this;
    }

    PersonBuilder lastName(String v) {
        p.setLastName(v);
        return this;
    }

    PersonBuilder id(int v) {
        p.setId(v);
        return this;
    }

    PersonBuilder age(int v) {
        p.setAge(v);
        return this;
    }

    Person build() {
        return p;
    }

}
