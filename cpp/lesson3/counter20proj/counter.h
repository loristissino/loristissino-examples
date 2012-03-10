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
	void _inc();
	void _dec();
	
	public:
	string name;

	static int position;
	static int getPosition();
	
	Counter();
	
	Counter(int min, int max);
	
	~Counter();
	
	virtual string toString();
	
	bool init(int min, int max);
	
	int getMin();
	
	int getMax();

	Counter  &setMin(int v);
	
	Counter  &setMax(int v);
	
	Counter &setName(string v);
	
	virtual Counter &count();
	
	virtual Counter &display();

	virtual Counter & operator++();     // ++mycounter;
	virtual Counter & operator++(int);  // mycounter++;
	virtual Counter & operator--();     // --mycounter;
	virtual Counter & operator--(int);  // mycounter--;
	
};




