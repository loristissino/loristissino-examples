#include <iostream>
#include <string>
#include "counter.h"
using namespace std;

int main()
{
    Counter c = Counter();
    c.SetMin(10);
    c.SetMax(20);
    c.SetName("STACKCOUNTER");
    c.Display();
    return 0;
}
