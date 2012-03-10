#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#ifndef COUNTER_
#define COUNTER_
#include "counter.h"
#endif

#define UNTITLED "untitled"

using namespace std;


class InvertedCounter: public Counter
{
	public:
		InvertedCounter();
	
		InvertedCounter(int min, int max);

		string toString();
		string toStringNV();
		Counter &count();
};


