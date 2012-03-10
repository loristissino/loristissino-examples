#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>

/*

Implementazione di un'interfaccia fluente 
http://en.wikipedia.org/wiki/Fluent_interface

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
	
	void _init()
	{
		cout << "DEBUG: _init()" << endl;
		name="untitled";
	}
	
	public:
		string name;
	
	Counter()
	{
		cout << "DEBUG: vengo automaticamente invocato, sono il 'costruttore'." << endl;
		_init();
	}
	
	Counter(int min, int max)
	{
		cout << "DEBUG: sono un costruttore 'alternativo'." << endl;
		init(min, max);
		_init();
	}
	
	~Counter()
	{
		cout << "DEBUG: vengo automaticamente invocato, sono il 'distruttore'." << endl;
	}
	
	string toString()
	{
		std::stringstream s;
		s << "Sono un contatore, mi chiamo '" << name << "', vado da " << getMin() << " a " << getMax() << ".";
		return s.str();
		
	}
	
	bool init(int min, int max)
	{
		cout << "DEBUG: inizializzazione." << endl;
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
		cout << "DEBUG: impostato il minimo a " << v << endl;
		return *this;
	}
	
	Counter  &setMax(int v)
	{
		_max=v;
		cout << "DEBUG: impostato il massimo a " << v << endl;
		return *this;
	}
	
	Counter &setName(string v)
	{
		name = v;
		cout << "DEBUG: impostato il nome a " << v << endl;
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

	
	Counter k = Counter(min, max);
	k
	.display()
	.count()
	.setMin(min+100)
	.setMax(max+100)
	.setName("Foo")
	.display()
	.count()
	;
	
	
}

