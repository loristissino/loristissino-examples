all: counter

counter: main.o counter.o functions.o
	g++ main.o counter.o functions.o -o counter

main.o: main.cpp
	g++ -c main.cpp

counter.o: counter.cpp
	g++ -c counter.cpp

functions.o: functions.cpp
	g++ -c functions.cpp

clean:
	rm -rf *o counter
