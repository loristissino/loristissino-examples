#include <iostream>
#include <iomanip>
#include <string>
#include <sstream>

/*

Creiamo un piccolo contatore che ci mostra tutti i numeri compresi tra due estremi...
Verifichiamo innanzitutto di essere in grado di leggere i parametri della riga di comando.

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
	int v;
	
	if (argc>1)
	{
		if(int_from_string(v, argv[1], dec))
		{
			cout << v << endl;
			return 0;
		}
		else
		{
			cerr << "conversione fallita" << endl;
			return 1;
		}

	}
}

