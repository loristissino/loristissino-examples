#!/usr/bin/env python3

import random
import sys

def printOnStderr(text):
    print(text, file=sys.stderr)

def run():
    left=0;
    right=101;
    while True:
        myGuess = (right+left)//2;
        print(myGuess);
        printOnStderr(f"Guesser - Trying {myGuess}, my bounds being {left}...{right} (excluded)");
        response = input();

        printOnStderr(f"Guesser - Handling input '{response}'");
        if (response==">"):
            left = myGuess;
            continue;
        if (response=="<"):
            right = myGuess;
            continue;
        if (response=="!"):
            printOnStderr(f"Guesser - Guessed it! :-)");
            break;

if __name__=="__main__":
    run()
