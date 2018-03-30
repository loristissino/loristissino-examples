package it.tissino.missions;

public class Person {
    String _firstName;

    Dog _dog;

    public void setDog(Dog dog)
    {
        _dog = dog;
    }
    public Dog getDog()
    {
        return _dog;
    }

    public Person(String firstName)
    {
        _firstName = firstName;
    }

    @Override
    public String toString()
    {
        return _firstName;
    }




}
