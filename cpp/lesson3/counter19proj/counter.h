#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#define UNTITLED "untitled"

using namespace std;


class Counter
{
	protected:

		void _init();

	private:
		int _min, _max;
	
	
	public:
		string name;
	
	Counter();
	
	Counter(int min, int max);
	
	~Counter();
	
	virtual string toString();
	string toStringNV();
	
	bool init(int min, int max);
	
	int getMin();
	
	int getMax();

	Counter  &setMin(int v);
	
	Counter  &setMax(int v);
	
	Counter &setName(string v);
	
	virtual Counter &count();
	
	virtual Counter &display();
	
};


