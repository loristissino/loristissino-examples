#include <iostream>
#include <iomanip>
#include <string>

using namespace std;

int main()
{
	float n;
	string s;
	cout << "Inserisci un numero:" << endl;
	cin >> n;
	cout << "Inserisci una stringa:" << endl;
	cin >> s;
	cout << setprecision(4) << n << endl;
	cout << s << endl;
}
