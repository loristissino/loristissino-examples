#include <iostream>
#include <iomanip>
#include <string>
#include <stdexcept>

#include "counter.h"
#include "invertedcounter.h"
#include "functions.h"

#define COUNTERS 6

using namespace std;

int main(int argc, char **argv)
{
	int min, max;

	if (argc!=3)
	{
		cerr << "Uso: " << argv[0] << " *lim_min*  *lim_max*" << endl;
		return 1;
	}
	if (!int_from_string(min, argv[1], dec))
	{
		cerr << "limite inferiore non valido" << endl;
		return 2;
	}
	if (!int_from_string(max, argv[2], dec))
	{
		cerr << "limite superiore non valido" << endl;
		return 3;
	}

	Counter *c[COUNTERS]; // un array di puntatori ad oggetti di tipo Counter

	int i;
	for (i=0; i<COUNTERS; i++)
	{
		if (i%2==0) // se i è pari...
		{
			c[i] = new Counter(min+i, max+i);
		}
		else
		{
			c[i] = new InvertedCounter(min+i, max+i);
		}
	}
	
	for (i=0; i<COUNTERS; i++)
	{
		c[i]->display();
		c[i]->count();
	}

	Counter *k;
	k=c[0];

	for (i=1; i<COUNTERS; i++)
	{
		cout << "DEBUG:: elimino contatore con id "<< i << endl;
		delete c[i];
	}

	k->display();

	cout << "DEBUG:: elimino primo contatore" << endl;
	delete k;

	cout << "--- METODI VIRTUALI ---" << endl;

	/* avendo definito un metodo virtuale toString() e un metodo non virtuale
	toStringNV() possiamo verificare cosa succede quando si richiama i due 
	metodi nei diversi casi. */

	Counter *cic = new InvertedCounter();
	cout << "toString() di cic: " << cic->toString() << endl;
	cout << "toStringNV() di cic: " << cic->toStringNV() << endl;
	delete cic;

	InvertedCounter *iic = new InvertedCounter();
	cout << "toString() di iic: " << iic->toString() << endl;
	cout << "toStringNV() di iic: " << iic->toStringNV() << endl;
	delete iic;

}

