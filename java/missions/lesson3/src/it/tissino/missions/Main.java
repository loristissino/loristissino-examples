package it.tissino.missions;

public class Main {

    public static void main(String[] args) {
	// write your code here

        Person p = new Person("Philip");

        Squad s = new Squad("00", "London");

        Agent jb = new Agent("James", 7, s);
        Agent fl = new Agent("Felix", 8, s);
        Agent jd = new Agent("John", 9, null); // this is legal

        jb.addLanguage("en");
        jb.addLanguage("fr_FR");
        jb.addLanguage("ru_RU");
        // TODO we should be able to avoid duplicates

        System.out.println(jb._firstName + " " + jb._squad);

        System.out.println(s.getAgents());

    }
}
