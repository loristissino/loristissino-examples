package it.tissino.people;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileNotFoundException;
import java.io.IOException;

public class Main {

    public static void main(String[] args) {

        runTests();

        try {
            BufferedReader br = new BufferedReader(new FileReader(args[0]));

            String line = br.readLine();

            while (line != null) {
                process(line);
                line = br.readLine();
            }
        }
        catch (FileNotFoundException e) {
            System.err.println("File not found");
        }
        catch (IOException e) {
            System.err.println("Input/Output Error");
        }
        catch (ArrayIndexOutOfBoundsException e) {
            System.err.println("Missing file name on command line");
        }
        catch (Exception e) {
            System.err.println("Generic Exception");
            System.err.println(e);
        }
    }

    public static void process(String s) {
        System.out.println(s);
        PersonBuilder pb = new PersonBuilder();
        Person p = pb.create().fromString(s).build();
        System.out.println(p);
    }

    public static void runTests() {
        Person p1 = new Person();

        p1.setId(53);
        p1.setAge(47);
        p1.setFirstName("Giorgio");
        p1.setLastName("Neri");

        Person p2 = new Person(54, 48, "Rossella", "Gialli");

        Person p3 = new Person();
        p3.setId(67).setAge(88).setFirstName("Giacomo");

        System.out.println(p1);
        // [53] Giorgio Neri, età: 47
        System.out.println(p2.getFirstName());
        // Giorgio
        System.out.println(p3);
        //System.out.println(p2);

        PersonBuilder pb = new PersonBuilder();

        Person a1 = pb
                .create()
                .id(90)
                .firstName("Davide")
                .lastName("Bianchi")
                .build()
                ;

        System.out.println(a1);

        String s="12\tMario\tRossi\t53";

        Person a2 = pb
                .create()
                .fromString(s)
                .build()
                ;

        System.out.println(a2);
    }
}
