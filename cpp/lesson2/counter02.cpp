#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>

/*

Visualizziamo i valori nel caso i parametri siano corretti

*/

using namespace std;

bool int_from_string(int &v, const std::string& s, std::ios_base& (*f)(std::ios_base&))
// adattata da: http://www.codeguru.com/forum/showthread.php?t=231054
{
  std::istringstream iss(s);
  return !(iss >> f >> v).fail();
}

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
	
	int i, k;
	for (k=max, i=min; i<max; i++)
	{
		cout << i << " (" << --k <<")" << ", ";
	}
	cout << max << endl;
}

