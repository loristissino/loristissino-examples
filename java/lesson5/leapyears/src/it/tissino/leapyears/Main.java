package it.tissino.leapyears;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileNotFoundException;
import java.io.IOException;

public class Main {

    public static boolean isLeap(int year)
    {
        if (year%4!=0)
            return false;
        if (year%400==0)
            return true;
        if (year%100==0)
            return false;
        return true;
    }

    /*
    public static boolean isLeap(int year)
    {
        return (year%4==0 && year%100!=0 || year%400==0);
    }
    */

    public static void runTests() {
        // just a short introduction to the philosophy of
        // TDD (test-driven development)
        // ---
        // read more about TDD in Java here: https://junit.org

        System.out.println(isLeap(2018)==false);
        System.out.println(isLeap(2017)==false);
        System.out.println(isLeap(2016)==true);
        System.out.println(isLeap(2020)==true);
        System.out.println(isLeap(1900)==false);
        System.out.println(isLeap(1800)==false);
        System.out.println(isLeap(2100)==false);
        System.out.println(isLeap(2300)==false);
        System.out.println(isLeap(2000)==true);
        System.out.println(isLeap(2400)==true);
        System.out.println(isLeap(1600)==true);
    }

    public static void main(String[] args) {
        // runTests();

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
        /*
        finally {
            System.err.println("Passing here anyway!");
        }*/
    }

    public static void process(String s)
    {
        try {
            int year = Integer.parseInt(s.trim().replaceAll("\\.|\\,", ""), 10);

            if (year<1582 || year > 9999) {
                System.err.println(year);
            }
            else {
                String t="not leap";
                if (isLeap(year))
                    t = "leap";
                System.out.println(year + ": " + t);
                //System.out.println(year + ": " + (isLeap(year) ? "leap" : "not leap"));
            }
        }
        catch (NumberFormatException e) {
            System.err.println(s);
        }
    }
}
