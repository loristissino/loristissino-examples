#!/bin/bash

left=0
right=101

while true; do
    # Calculate middle point
    myGuess=$(( (right + left) / 2 ))
    
    # Send guess to stdout
    echo "$myGuess"
    
    # Debug info to stderr
    echo "Guesser - Trying $myGuess, my bounds being $left...$right (excluded)" >&2
    
    # Read response from stdin
    if ! read -r response; then
        break
    fi

    echo "Guesser - Handling input '$response'" >&2

    if [[ "$response" == ">" ]]; then
        left=$myGuess
    elif [[ "$response" == "<" ]]; then
        right=$myGuess
    elif [[ "$response" == "!" ]]; then
        echo "Guesser - Guessed it! :-)" >&2
        break
    fi
done
