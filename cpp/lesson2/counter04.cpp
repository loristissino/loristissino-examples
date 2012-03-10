#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>


/*

Aggiungiamo una variabile membro pubblica, accessibile anche dall'esterno.

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
		string name;
	
	bool init(int min, int max)
	{
		_min = min;
		_max = max;
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
	
	c.init(min, max);
	
	cout << "Ho un contatore che va da " << c.getMin() << " a " << c.getMax() << "." << endl;
	
	c.name="MicroWaveCounter";
	
	cout << "Il contatore si chiama " << c.name << "." << endl;
	
	
}

