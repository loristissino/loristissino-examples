#include <iostream>
#include <iomanip>
#include <string>

using namespace std;

int main(int argc, char **argv)
{
	cout << "Parametri passati sulla riga di comando: " << argc << endl;
	int i, k;
	for (i=0, k=argc-1; i < argc; i++, k--)  // più inizializzazioni, più operazioni eseguite ad ogni esecuzione
	{
		cout << i << ": " << argv[i] << " (" << k << " alla fine)" << endl;
	}

  // Se i parametri non sono tre (compreso il programma), usciamo con errore 
	
	return (argc==3) ? 0 : 1; // zucchero sintattico...





}
