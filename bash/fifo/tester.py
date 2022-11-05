#!/usr/bin/env python3

import random
import sys

def printOnStderr(text):
    print(text, file=sys.stderr)

def run():
    numberToGuess = random.randint(1, 100)
    printOnStderr(f"Tester  - Number to guess set to {numberToGuess}")
    count = 0
    while True:
        guess = int(input())
        count+=1
        printOnStderr(f"Tester  - Handling input '{guess}'")
        if guess == numberToGuess:
            print("!")
            printOnStderr(f"Tester  - Number guessed in {count} attempts.")
            break
        if numberToGuess < guess:
            print("<")
        else:
            print(">")

if __name__=="__main__":
    run()
    
