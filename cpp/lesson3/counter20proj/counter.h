#ifndef COUNTER_H
#define COUNTER_H

#define UNTITLED "untitled"

class Counter
{
	protected:
    void _init();

	private:

    int _min, _max;
    void _inc();
    void _dec();
	
	public:
    std::string name;

    static int position;
    static int getPosition();
    
    Counter();
    
    Counter(int min, int max);
    
    ~Counter();
    
    virtual std::string toString();
    
    bool init(int min, int max);
    
    int getMin();
    
    int getMax();

    Counter  &setMin(int v);
    
    Counter  &setMax(int v);
    
    Counter &setName(std::string v);
    
    virtual Counter &count();
    
    virtual Counter &display();

    virtual Counter & operator++();     // ++mycounter;
    virtual Counter & operator++(int);  // mycounter++;
    virtual Counter & operator--();     // --mycounter;
    virtual Counter & operator--(int);  // mycounter--;
	
};

#endif
