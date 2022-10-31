# Guess the number -- Example of two processes in dialogue through a named pipe

Two independent programs deal with the "guess the number" problem.

The program `tester` sets a number to guess, receives in its standard
input a number and writes on its standard output the symbols `>`, `>` 
if the number to guess is greater or lower than the number to guess,
or `!` if the number has been guessed.

The program `guesser` tries different numbers until it guesses the one
set by the other program.

Both programs communicate via standard input and standard output, but
output their messages, for us to read, on their standard error.

We need a named pipe (you can create one with `mkfifo mypipe`) to let 
the processes have a double-way communication.

    $ mono guesser.exe < mypipe | mono tester.exe > mypipe
    Tester  - Number to guess set to 38
    Guesser - Trying 50, my bounds being 1...100
    Tester  - Handling input '50'
    Guesser - Handling input '<'
    Guesser - Trying 25, my bounds being 1...50
    Tester  - Handling input '25'
    Guesser - Handling input '>'
    Guesser - Trying 37, my bounds being 25...50
    Tester  - Handling input '37'
    Guesser - Handling input '>'
    Guesser - Trying 43, my bounds being 37...50
    Tester  - Handling input '43'
    Guesser - Handling input '<'
    Guesser - Trying 40, my bounds being 37...43
    Tester  - Handling input '40'
    Guesser - Handling input '<'
    Guesser - Trying 38, my bounds being 37...40
    Tester  - Handling input '38'
    Tester  - Number guessed in 6 attempts.
    Guesser - Handling input '!'
    Guesser - Guessed it! :-)
