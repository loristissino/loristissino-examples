#include <sstream>

#include "functions.h"

bool int_from_string(int &v, const std::string& s, std::ios_base& (*f)(std::ios_base&))
// adattata da: http://www.codeguru.com/forum/showthread.php?t=231054
{
  std::istringstream iss(s);
  return !(iss >> f >> v).fail();
}

void swapv3(int &a, int &b)
{
	int c=a;
	a=b;
	b=c;
}


