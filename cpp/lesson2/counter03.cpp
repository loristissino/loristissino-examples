#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>

/*

Definiamo una classe e creiamo un'istanza della classe nel programma principale

*/

using namespace std;

bool int_from_string(int &v, const std::string& s, std::ios_base& (*f)(std::ios_base&))
// adattata da: http://www.codeguru.com/forum/showthread.php?t=231054
{
  std::istringstream iss(s);
  return !(iss >> f >> v).fail();
}


class Counter
{
	private:
		int _min, _max;
	
	public:
			
	bool init(int min, int max)
	{
		if (min<max)
		{
			_min = min;
			_max = max;
			return true;
		}
		return false;
	}
	
	int getMin()
	{
		return _min;
	}
	
	int getMax()
	{
		return _max;
	}
	
};

int main(int argc, char **argv)
{
	int min, max;
	
	if (argc!=3)
	{
		cerr << "Uso: " << argv[0] << " *lim_min*  *lim_max*" << endl;
		return 1;
	}
	if (!int_from_string(min, argv[1], dec))
	{
		cerr << "limite inferiore non valido" << endl;
		return 2;
	}
	if (!int_from_string(max, argv[2], dec))
	{
		cerr << "limite superiore non valido" << endl;
		return 3;
	}
	
	Counter c = Counter();
	
	if (!c.init(min, max))
	{
		cerr << "limiti accavallati" << endl;
		return 4;
	}
	
	cout << "Ho un contatore da " << c.getMin() << " a " << c.getMax() << "." << endl;
	
}

