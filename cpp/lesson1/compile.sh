#!/bin/bash
echo -n "compiling $1... "
g++ -o $1 $1.cpp
echo "done."


