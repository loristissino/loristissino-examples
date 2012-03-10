# Per compilare il programma sarà necessario compilare
# prima i singoli sorgenti cpp, ottenendo i moduli oggetto:

g++ -c functions.cpp   # da cui ottengo functions.o
g++ -c counter.cpp     # da cui ottengo counter.o
g++ -c main.cpp        # da cui ottengo main.o

Successivamente, il linker metterà insieme i moduli oggetto
consentendomi di ottenere l'eseguibile:

g++ -o counter functions.o counter.o main.o 

Ovviamente, tutti gli ambienti di sviluppo automatizzano 
queste operazioni (a partire dall'uso di un Makefile e del
programma make).

In questa directory si trovano:

* il file build.sh, script bash che esegue la compilazione
* il file Makefile, che consente di usare il programma make per ottenere
  lo stesso risultato digitando il comando "make"
  
Il vantaggio di usare make consiste nel fatto che make si accorge di
cosa c'è già ed evita di rifare la compilazione di sorgenti per i quali
esistono gli oggetti.
  
Esempi:

$ make
g++ -c main.cpp
g++ -c counter.cpp
g++ -c functions.cpp
g++ main.o counter.o functions.o -o counter


$ make
make: Nessuna operazione da eseguire per "all".


$ make clean
rm -rf *o counter



$ make
g++ -c main.cpp
g++ -c counter.cpp
g++ -c functions.cpp
g++ main.o counter.o functions.o -o counter


$ rm counter.o 
$ make
g++ -c counter.cpp
g++ main.o counter.o functions.o -o counter


Vedremo che il Makefile può essere migliorato.


