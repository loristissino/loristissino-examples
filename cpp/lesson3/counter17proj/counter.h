#define UNTITLED "untitled"

#ifndef COUNTER_H
#define COUNTER_H

class Counter
{
	private:
    int _min, _max;
	
    void _init();
	
	public:
		std::string name;
	
    Counter();
	
    Counter(int min, int max);
	
    ~Counter();
	
    std::string toString();
	
    bool init(int min, int max);
	
    int getMin();
	
    int getMax();

    Counter  &setMin(int v);
	
    Counter  &setMax(int v);
	
    Counter &setName(std::string v);
	
    Counter &count();
	
    Counter &display();
	
};

#endif

