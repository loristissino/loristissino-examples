package it.tissino.missions;

public class Dog implements Assignable {

    private Squad _squad;
    private String _name;

    private Tail _tail;

    public Dog(String name)
    {
        _name = name;
        _tail = new Tail();
        _tail._owner = this;
    }

    public Tail getTail()
    {
        return _tail;
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
        return "Dog " + _name + ", barking: " + bark() + " " + _tail.wag();
    }

    class Tail {
        private Dog _owner;
        public String wag()
        {
            return "wagging the tail (of " + _owner._name + ")!";
        }
    }



}
