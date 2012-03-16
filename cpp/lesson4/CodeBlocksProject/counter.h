#ifndef COUNTER_H
#define COUNTER_H

#include <string>
#include <iostream>

class Counter
{
    public:
        Counter();
         int GetMin() { return _min; }
        void SetMin( int val) { _min = val; }
         int GetMax() { return _max; }
        void SetMax( int val) { _max = val; }
        std::string GetName() { return name; }
        void SetName(std::string val) { name = val; }
        void Display();
    protected:
    private:
         int _min;
         int _max;
        std::string name;
};

#endif // COUNTER_H
