#!/bin/bash
g++ -c functions.cpp   # da cui ottengo functions.o
g++ -c counter.cpp     # da cui ottengo counter.o
g++ -c main.cpp        # da cui ottengo main.o
g++ -o counter functions.o counter.o main.o 

