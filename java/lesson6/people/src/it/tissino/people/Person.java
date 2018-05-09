package it.tissino.people;

import java.time.Year;

public class Person {
    int _id;
    private String _firstName;
    private String _lastName;
    private int _yob;

    public Person() {

    }

    public Person(int id, int age, String firstName, String lastName) {
        setId(id);
        setAge(age);
        setFirstName(firstName);
        setLastName(lastName);
    }

    public Person setId(int id) {
        if (id <0)
        {
            _id = 0;
        }
        _id = id;
        return this;
    }
    public Person setFirstName(String firstName) {
        _firstName = firstName;
        return this;
    }
    public Person setLastName(String lastName) {
        _lastName = lastName;
        return this;
    }
    public Person setAge(int age) {
        _yob = Year.now().getValue() - age;
        return this;
    }

    @Override
    public String toString() {
        return String.format(
                "[%d] %s %s, età: %d.",
                getId(), getFirstName(), getLastName(), getAge());
    }


    public int getId() {
        return _id;
    }

    public String getFirstName() {
        return _firstName;
    }

    public String getLastName() {
        return _lastName;
    }

    public int getAge() {
        return Year.now().getValue() - _yob ;
    }
}
