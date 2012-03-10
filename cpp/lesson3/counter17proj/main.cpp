#include <iostream>
#include <iomanip>
#include <string>
#include <stdexcept>

#include "counter.h"
#ifndef FUNCTIONS
#define FUNCTIONS
#include "functions.h"
#endif

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

	Counter *c = new Counter(min, max);
	c->display();
	delete c;
	
}

