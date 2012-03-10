#include <iostream>
#include <iomanip>
#include <string>

using namespace std;

int main(int argc, char **argv)
{
	cout << "Parametri passati sulla riga di comando: " << argc << endl;
	int i;
	for (i=0; i < argc; i++)
	{
		cout << i << ": " << argv[i] << endl;
	}
	cout << "Se i parametri non sono tre (compreso il programma), usciamo con errore" << endl;
	if (argc==3)
	{
		return 0;
	}
	else
	{
		return 1;
	}
}
