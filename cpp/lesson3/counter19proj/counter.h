#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>


#ifndef COUNTER_H
#define COUNTER_H

#define UNTITLED "untitled"

class Counter
{
	protected:

    void _init();

	private:
  
		int _min, _max;
	
	public:
    std::string name;
	
    Counter();
	
    Counter(int min, int max);
	
    ~Counter();
	
    virtual std::string toString();
    std::string toStringNV();
	
    bool init(int min, int max);
	
    int getMin();
	
    int getMax();

    Counter  &setMin(int v);
	
    Counter  &setMax(int v);
	
    Counter &setName(std::string v);
	
    virtual Counter &count();
	
    virtual Counter &display();
	
};

#endif

