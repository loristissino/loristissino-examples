package it.tissino.missions;

import java.util.ArrayList;

public class Squad {
    String _name;
    String _city;

    private ArrayList<Assignable> _elements = new ArrayList<Assignable>();

    public Squad(String name, String city)
    {
        _name = name;
        _city = city;
    }

    public void addElement(Assignable element)
    {
        _elements.add(element);
    }

    public ArrayList<Assignable> getElements()
    {
        return _elements;
    }

    @Override
    public String toString()
    {
        return "Squad " + _name;
    }

    public static void assign(Assignable element, Squad squad)
    {
        if (squad instanceof Squad)
            squad.addElement(element);
    }
}
