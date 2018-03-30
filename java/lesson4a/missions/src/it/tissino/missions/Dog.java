package it.tissino.missions;

public class Dog implements Assignable {

    private Squad _squad;
    private String _name;

    public Dog(String name)
    {
        _name = name;
    }

    public void setSquad(Squad squad)
    {
        _squad = squad;
        if (_squad instanceof Squad)
            _squad.addElement(this);
    }
    public String bark()
    {
        return "Woof!";
    }

    @Override
    public String toString()
    {
        return "Dog " + _name + " who barks: " + bark();
    }

}
