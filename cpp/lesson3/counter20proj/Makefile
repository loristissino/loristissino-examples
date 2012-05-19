CC=g++
CFLAGS=-c -Wall

EXECUTABLE=counter
FILES=counter.o invertedcounter.o functions.o main.o

all: $(EXECUTABLE)

.c.o:
	$(CC) $(CFLAGS) $*.c -o $@

$(EXECUTABLE): $(FILES)
	$(CC)	$(FILES) -o $(EXECUTABLE)

clean:
	rm -rf *o $(EXECUTABLE)
