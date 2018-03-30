package it.tissino.missions;

public class Main {

    public static void main(String[] args) {

        Person p = new Person("Philip");

        Squad s = new Squad("00", "London");

        Agent jb = new Agent("James", 7, s);
        Agent fl = new Agent("Felix", 8, s);
        Agent jd = new Agent("John", 9, null); // this is legal

        jb.addLanguage("en");
        jb.addLanguage("fr_FR");
        jb.addLanguage("fr_FR"); // multiple additions should make no harm
        jb.addLanguage("fr_FR");
        jb.addLanguage("ru_RU");

        System.out.println(jb._firstName + " " + jb._squad);
        System.out.println(jb.getLanguages());

        System.out.println(s.getElements());

        Dog bill = new Dog("Bill");
        bill.setSquad(s);

        for (int i=0; i<s.getElements().size(); i++)
        {
            System.out.println(i + ") " + s.getElements().get(i));
        }

    }
}
