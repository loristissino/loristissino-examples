CC=g++
CFLAGS=-c -Wall

all: counter

.c.o:
	$(CC) $(CFLAGS) $*.c -o $@

counter: main.o counter.o functions.o invertedcounter.o
	$(CC)	main.o counter.o functions.o invertedcounter.o -o counter

clean:
	rm -rf *o counter
