package com.company;
import java.util.Scanner;

public class Main {

    public static int askCheckedNumber(String message)
    {
        Scanner s = new Scanner(System.in);
        int r=0;
        boolean validAnswer = false;
        while (!validAnswer) {
            System.out.println(message);
            String answer=s.nextLine();
            try {
                r = Integer.parseInt(answer);
                validAnswer = true;
            } catch (Exception e) {
                System.out.println("Invalid input. Please try with a number.");
            }
        }
        return r;
    }

    public static void main(String[] args) {
	// write your code here
        int eggs = askCheckedNumber("Number of eggs?");
        System.out.println(String.format("You have %d eggs, apparently.", eggs));
    }
}
