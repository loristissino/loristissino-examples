using System;

public class Tester
{
    public static void Main(string[] args)
    {
        int numberToGuess = (new Random()).Next(1,101);
        Console.Error.WriteLine($"Tester  - Number to guess set to {numberToGuess}");
        int count = 0;
        int guess;
        string response;
        while (true) {
            response = Console.ReadLine();
            if (string.IsNullOrEmpty(response)) {
                continue;
            }
            Int32.TryParse(response, out guess);
            Console.Error.WriteLine($"Tester  - Handling input '{guess}'");
            count++;
            if (numberToGuess < guess) {
                Console.WriteLine("<");
            }
            else if (numberToGuess > guess) {
                Console.WriteLine(">");
            }
            else {
                Console.WriteLine("!");
                Console.Error.WriteLine($"Tester  - Number guessed in {count} attempts.");
                break;
            }
        }
    }
}
