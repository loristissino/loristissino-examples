package it.tissino.missions;

import java.util.LinkedHashSet;

public class Agent extends Person implements Assignable {
    Squad _squad;
    int _id;
    private LinkedHashSet<String> _languages = new LinkedHashSet<String>();

    public Agent(String firstName, int id, Squad squad)
    {
        super(firstName);
        _id = id;
        setSquad(squad);
    }

    public void setSquad(Squad squad)
    {
        _squad = squad;
        Squad.assign(this, squad);
        // TODO we should also remove the agent from the old Squad
    }

    public void addLanguage(String language)
    {
        if (language.equals("en")) // just an example...
            language = "en_GB";
        _languages.add(language);
    }
    public void removeLanguage(String language)
    {
        _languages.remove(language);
    }
    public LinkedHashSet<String> getLanguages()
    {
        return _languages;
    }

    @Override
    public String toString()
    {
        return "SA " + _firstName;
    }


}
