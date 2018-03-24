package it.tissino.missions;

import java.util.ArrayList;

public class Agent extends Person{
    Squad _squad;
    int _id;
    private ArrayList<String> _languages = new ArrayList<String>();

    public Agent(String firstName, int id, Squad squad)
    {
        super(firstName);
        _id = id;
        _squad = squad;
        if (_squad instanceof Squad)
            _squad.addAgent(this);
    }

    public void addLanguage(String language)
    {
        _languages.add(language);
    }
    public void removeLanguage(String language)
    {
        _languages.remove(language);
    }
    public ArrayList<String> getLanguages()
    {
        return _languages;
    }



}
