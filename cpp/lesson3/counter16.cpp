#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>
#include <stdexcept>

#define UNTITLED "untitled"
//#define ARRAYSIZE 1048576 // 1 MiB
//#define ARRAYSIZE 67108864 // 64 MiB
#define ARRAYSIZE 536870912 // 512 MiB

/*

Gestione dell'eccezione con try... catch per il caso di esaurimento della memoria

*/

using namespace std;

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


class Counter
{
	private:
		int _min, _max;
		char _values[ARRAYSIZE]; // un array privato di ARRAYSIZE byte...
	
	void _init()
	{
		name=UNTITLED;
	}
	
	public:
		string name;
	
	Counter()
	{
		_init();
	}
	
	Counter(int min, int max)
	{
		init(min, max);
		_init();
	}
	
	~Counter()
	{
	}
	
	string toString()
	{
		std::stringstream s;
		s << "Sono un contatore, mi chiamo '" << name << "', vado da " << getMin() << " a " << getMax() << ".";
		return s.str();
		
	}
	
	bool init(int min, int max)
	{	
		if(max<min)
		{
			swapv3(min, max);
		}
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

	Counter  &setMin(int v)
	{
		_min=v;
		return *this;
	}
	
	Counter  &setMax(int v)
	{
		_max=v;
		return *this;
	}
	
	Counter &setName(string v)
	{
		name = v;
		return *this;
	}
	
	Counter &count()
	{
		int i;
		for (i=getMin(); i<getMax(); i++)
		{
			cout << i << ", ";
		}
		cout << getMax() << endl;
		
		return *this;
	}
	
	Counter &display()
	{
		cout << toString() << endl;
		return *this;
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

	int c=0;
	while (true)
	{
		cout << "creo contatore n. " << ++c << "..." << endl;
		try
		{
			Counter *k = new Counter(min, max);
			k->display();
			cout << "fatto!" << endl;
		}
		catch (exception &e)
		{
			cout << "memoria esaurita." << endl;
			break;
		}
	}

	
	
	
}

