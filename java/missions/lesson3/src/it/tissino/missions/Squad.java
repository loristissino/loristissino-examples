package it.tissino.missions;

import java.util.ArrayList;

public class Squad {
    String _name;
    String _city;

    private ArrayList<Agent> _agents = new ArrayList<Agent>();

    public Squad(String name, String city)
    {
        _name = name;
        _city = city;
    }

    public void addAgent(Agent agent)
    {
        _agents.add(agent);
    }

    public ArrayList<Agent> getAgents()
    {
        return _agents;//.size();
    }

    public String toString()
    {
        return "Squad " + _name;
    }
}
