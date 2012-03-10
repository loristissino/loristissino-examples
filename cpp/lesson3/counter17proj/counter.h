#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#define UNTITLED "untitled"

using namespace std;


class Counter
{
	private:
		int _min, _max;
	
	void _init();
	
	public:
		string name;
	
	Counter();
	
	Counter(int min, int max);
	
	~Counter();
	
	string toString();
	
	bool init(int min, int max);
	
	int getMin();
	
	int getMax();

	Counter  &setMin(int v);
	
	Counter  &setMax(int v);
	
	Counter &setName(string v);
	
	Counter &count();
	
	Counter &display();
	
};


