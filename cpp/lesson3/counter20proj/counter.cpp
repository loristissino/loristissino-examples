#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#include "counter.h"
#include "functions.h"

using namespace std;

int Counter::getPosition()
{
	return position;
}

void Counter::_init()
{
	name=UNTITLED;
	Counter::position++;
	setMin(0);
	setMax(0);
}
	
Counter::Counter()
{
	_init();
}
	
Counter::Counter(int min, int max)
{
	init(min, max);
	_init();
}
	
Counter::~Counter()
{
}
	
string Counter::toString()
{
	stringstream s;
	s << "Sono un contatore, mi chiamo '" << name << "', vado da " << getMin() << " a " << getMax() << ".";
	return s.str();
	
}
	
bool Counter::init(int min, int max)
{	
	if(max<min)
	{
		swapv3(min, max);
	}
	_min = min;
	_max = max;
}
	
int Counter::getMin()
{
	return _min;
}
	
int Counter::getMax()
{
	return _max;
}

Counter & Counter::setMin(int v)
{
	_min=v;
	return *this;
}
	
Counter & Counter::setMax(int v)
{
	_max=v;
	return *this;
}
	
Counter & Counter::setName(string v)
{
	name = v;
	return *this;
}
	
Counter & Counter::count()
{
	int i;
	for (i=getMin(); i<getMax(); i++)
	{
		cout << i << ", ";
	}
	cout << getMax() << endl;
	
	return *this;
}
	
Counter & Counter::display()
{
	cout << toString() << endl;
	return *this;
}

void Counter::_inc()
{
	setMin(getMin()+1);
	setMax(getMax()+1);
}

void Counter::_dec()
{
	setMin(getMin()-1);
	setMax(getMax()-1);
}


Counter & Counter::operator++()
{
	_inc();
	return *this;
}

Counter & Counter::operator++(int)
{
	_inc();
	return *this;
}

Counter & Counter::operator--()
{
	_dec();
	return *this;
}
	
Counter & Counter::operator--(int)
{
	_dec();
	return *this;
}


int Counter::position=0;

