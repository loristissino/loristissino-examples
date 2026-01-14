#!/bin/bash

# $RANDOM returns 0-32767; this gets us 1-100
numberToGuess=$(( (RANDOM % 100) + 1 ))
echo "Tester  - Number to guess set to $numberToGuess" >&2

count=0
while true; do
    # Read guess from stdin
    if ! read -r guess; then
        break
    fi
    
    ((count++))
    echo "Tester  - Handling input '$guess'" >&2

    if (( guess == numberToGuess )); then
        echo "!"
        echo "Tester  - Number guessed in $count attempts." >&2
        break
    elif (( numberToGuess < guess )); then
        echo "<"
    else
        echo ">"
    fi
done
