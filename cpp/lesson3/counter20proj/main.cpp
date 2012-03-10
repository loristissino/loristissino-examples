#include <iostream>
#include <iomanip>
#include <string>
#include <stdexcept>

#ifndef COUNTER_
#define COUNTER_
#include "counter.h"
#endif

#ifndef INVERTEDCOUNTER_
#define INVERTEDCOUNTER_
#include "invertedcounter.h"
#endif

#ifndef FUNCTIONS
#define FUNCTIONS
#include "functions.h"
#endif

#define COUNTERS 6

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


	Counter c = Counter(min, max);
	c.setName("STACKCOUNTER");
	c.display();
	c++;
	c.display();
	c++;
	c.display();
	c--;
	c.display();

	cout << (--c).toString() << endl;
	cout << (c--).toString() << endl;
	cout << (c--).toString() << endl;

	cout << "posizione: " << Counter::getPosition() << endl;

	Counter *n = new Counter();
	n->display();

	cout << "posizione: " << Counter::getPosition() << endl;


	/*

	Counter *c = new Counter(min, max);
	c->display();
	(*c)++;
	c->display();
	(*c)--;
	c->display();

	delete c;
*/
}

