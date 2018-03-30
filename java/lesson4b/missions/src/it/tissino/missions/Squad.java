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

    public boolean equals(Squad s)
    {
        return this._name == s._name;
    }

    public void addElement(Assignable element)
    {
        _elements.add(element);
    }

    public ArrayList<Assignable> getElements()
    {
        return _elements;
    }

    public ArrayList<Assignable> getElements(Class c)
    {
        ArrayList<Assignable> result = new ArrayList<Assignable>();

        for (int i=0; i< _elements.size(); i++)
        {
            if (c.isInstance(_elements.get(i)))
            {
                result.add(_elements.get(i));
            }
        }
        return result;
    }

    /*
    public ArrayList<Agent> getAgents()
    {
        ArrayList<Agent> result = new ArrayList<Agent>();
        for (int i=0; i< _elements.size(); i++)
        {
            if (_elements.get(i) instanceof Agent)
            {
                result.add((Agent)_elements.get(i));
            }
        }
        return result;
    }
    */

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
