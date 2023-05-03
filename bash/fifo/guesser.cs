using System;

public class Guesser
{
    public static void Main(string[] args)
    {
        int left=0;
        int right=101;
        int myGuess;
        string response;
        while (true) {
            myGuess = (right+left)/2;
            Console.WriteLine(myGuess);
            Console.Error.WriteLine($"Guesser - Trying {myGuess}, my bounds being {left}...{right} (excluded)");
            response = Console.ReadLine();
            if (string.IsNullOrEmpty(response)) {
                continue;
            }
            Console.Error.WriteLine($"Guesser - Handling input '{response}'");
            if (response==">") {
                left = myGuess;
                continue;
            }
            if (response=="<") {
                right = myGuess;
                continue;
            }
            if (response=="!") {
                Console.Error.WriteLine($"Guesser - Guessed it! :-)");
                break;
            }
        }
    }
}
