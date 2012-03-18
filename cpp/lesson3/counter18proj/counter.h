#define UNTITLED "untitled"

#ifndef COUNTER_H
#define COUNTER_H

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
	
    bool init(int min, int max);
	
    int getMin();
	
    int getMax();

    Counter &setMin(int v);
	
    Counter &setMax(int v);
	
    Counter &setName(std::string v);
	
    virtual Counter &count();
	
    virtual Counter &display();
	
};

#endif

