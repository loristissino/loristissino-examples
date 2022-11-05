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

## C\# version

The programs must be compiled with `mcs`. Then:

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

The two processes could run in different terminals. In this case, you
need to create two named pipes, for instance `pipet2g` (tester to guesser)
and `pipeg2t` (guesser to tester), and then launch the two programs
as follows:

    # from one terminal
    $ mono guesser.exe > pipeg2t < pipet2g 
    Guesser - Trying 50, my bounds being 1...100
    Guesser - Handling input '<'
    Guesser - Trying 25, my bounds being 1...50
    Guesser - Handling input '>'
    Guesser - Trying 37, my bounds being 25...50
    Guesser - Handling input '<'
    Guesser - Trying 31, my bounds being 25...37
    Guesser - Handling input '!'
    Guesser - Guessed it! :-)

    # from the other terminal
    $ mono tester.exe < pipeg2t > pipet2g
    Tester  - Number to guess set to 31
    Tester  - Handling input '50'
    Tester  - Handling input '25'
    Tester  - Handling input '37'
    Tester  - Handling input '31'
    Tester  - Number guessed in 4 attempts.

## Python version

Set execution permissions to the python files. Then:

    ./guesser.py < mypipe | ./tester.py > mypipe

