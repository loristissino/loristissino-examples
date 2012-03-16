#include "counter.h"

using namespace std;

Counter::Counter()
{
    //ctor
}

void Counter::Display()
{
    cout << "I am a counter, my name is " << GetName() << "." << endl;
}
