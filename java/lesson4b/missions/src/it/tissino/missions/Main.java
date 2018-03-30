package it.tissino.missions;
import java.util.ArrayList;
import java.io.BufferedReader;
import java.io.FileReader;

import java.io.FileNotFoundException;
import java.io.IOException;

public class Main {

    static Class c;

    public static void main(String[] args) {

        Person p = new Person("Philip");

        Squad s = new Squad("00", "London");

        Agent jb = new Agent("James", 7, s);
        Agent fl = new Agent("Felix", 8, s);
        Agent jd = new Agent("John", 9, null); // this is legal

        jb.addLanguage("en");
        jb.addLanguage("fr_FR");
        jb.addLanguage("fr_FR");
        jb.addLanguage("fr_FR");
        jb.addLanguage("ru_RU");

        System.out.println(jb._firstName + " " + jb._squad);
        System.out.println(jb.getLanguages());

        System.out.println(s.getElements());

        Dog bill = new Dog("Bill");
        bill.setSquad(s);

        Dog chingchang = new Dog("Ching Chang") {
            @Override
            public String bark() {
                return "wan wan";
            }
        };
        chingchang.setSquad(s);

        System.out.println(s.getElements());

        for (int i = 0; i < s.getElements().size(); i++) {
            System.out.println(i + ") " + s.getElements().get(i));
        }

        System.out.println(chingchang.getTail().wag());

        ArrayList<Agent> l = s.getAgents();

        System.out.println(l);

        try {
            c = Class.forName("it.tissino.missions.Agent");
        } catch (ClassNotFoundException e) {
            System.out.println("class not found");
        }

        System.out.println(s.getElements(c));

        c = bill.getClass();

        System.out.println(s.getElements(bill.getClass()));

        System.out.println("-----  dogs  -----");

        for (int i = 0; i < s.getElements(c).size(); i++) {
            Dog d = (Dog) s.getElements(c).get(i);
            System.out.println(d.bark());
        }

    }
}
