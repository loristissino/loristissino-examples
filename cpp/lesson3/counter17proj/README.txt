# Per compilare il programma sarà necessario compilare
# prima i singoli sorgenti cpp, ottenendo i moduli oggetto

g++ -c functions.cpp   # da cui ottengo functions.o
g++ -c counter.cpp     # da cui ottengo counter.o
g++ -c main.cpp        # da cui ottengo main.o

Successivamente, il linker metterà insieme i moduli oggetto
consentendomi di ottenere l'eseguibile:

g++ -o counter functions.o counter.o main.o 

Ovviamente, tutti gli ambienti di sviluppo automatizzano 
queste operazioni (a partire dall'uso di un Makefile e del
programma make).


