#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#include "invertedcounter.h"
#include "functions.h"

using namespace std;

InvertedCounter::InvertedCounter()
{
	_init();
}
	
InvertedCounter::InvertedCounter(int min, int max)
{
	init(min, max);
	_init();
}


string InvertedCounter::toString()
{
	std::stringstream s;
	s << "Sono un contatore inverso, mi chiamo '" << name << "', vado da " << getMax() << " a " << getMin() << ".";
	return s.str();
	
}
	
	
Counter & InvertedCounter::count()
{
	int i;
	for (i=getMax(); i>getMin(); i--)
	{
		cout << i << ", ";
	}
	cout << getMin() << endl;
	
	return *this;
}
	

