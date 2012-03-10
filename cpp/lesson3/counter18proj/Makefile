CC=g++
CFLAGS=-c -Wall

all: counter

counter: main.o counter.o functions.o invertedcounter.o
	$(CC) main.o counter.o functions.o invertedcounter.o -o counter

main.o: main.cpp
	$(CC) $(CFLAGS) main.cpp

counter.o: counter.cpp
	$(CC)  $(CFLAGS) counter.cpp

invertedcounter.o: invertedcounter.cpp
	$(CC)  $(CFLAGS) invertedcounter.cpp

functions.o: functions.cpp
	$(CC)  $(CFLAGS) functions.cpp

clean:
	rm -rf *o counter
