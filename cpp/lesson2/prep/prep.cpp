#include "init.h"
#include <iostream>

#define MIN 10
#define MAX 20
#define ERRCODE_MIN 1
#define ERRCODE_MAX 2
#define K a

int main(int argc, char **argv)
/* Questo codice serve a verificare il funzionamento del 
preprocessore.
Si può invocare il compilatore dicendo di fermarsi dopo
l'aver preprocessato il file passando l'opzione -E.
Esempio:

  g++ -E -o preprocessato.cpp prep.cpp

Guardando il file ottenuto, si dovrebbe osservare che:
a) i commenti sono stati rimossi
b) le costanti sono state sostituite (ma non si tratta di
   un semplice "find&replace", visto che nelle espressioni 
   tra apici la sostituzione non avviene)
c) viene incluso il testo presente nel file indicato
   nella direttiva #include

*/
{
	if (argc<MIN)
	{
		return ERRCODE_MIN;
	}
	if (argc>MAX)
	{
		return ERRCODE_MAX;
	}

	char k='K';
	int a=A;

	return 0;
}


