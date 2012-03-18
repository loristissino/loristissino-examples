#ifndef INVERTED_COUNTER_H
#define INVERTED_COUNTER_H

#include "counter.h"

class InvertedCounter: public Counter
{
	public:
		InvertedCounter();
	
		InvertedCounter(int min, int max);

		std::string toString();
		Counter &count();
};

#endif
