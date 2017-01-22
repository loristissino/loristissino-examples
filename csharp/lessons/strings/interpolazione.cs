using System;

public class Program
{
	public static void Main()
	{
    string name = "Philip";
    int age = 18;

    // vogliamo far comparire la scritta
    // "Philip ha 18 anni."

    // opzione 1
    Console.WriteLine(name + " ha " + age + " anni.");
    // non tanto bello: si fa uno spezzatino della frase:
    // è difficile da tradurre in altra lingua
    // non è possibile cambiare l'ordine degli elementi (prima l'etè e 
    // poi il nome senza modificare il codice dell'istruzione)

    Console.WriteLine("{0} ha {1} anni.", name, age);
    // meglio: la frase ha un suo senso compiuto, e i segnaposto
    // consentono cambiamenti se necessario:

    string fmt;
    int choice = 1;  // 0 per la forma "Philip ha 18 anni."
                     // 1 per la forma "Sono 18 gli anni di Philip."

    fmt = choice==0 ? "{0} ha {1} anni." : "Sono {1} gli anni di {0}.";
    Console.WriteLine(fmt, name, age);
    // il valore della stringa fmt dipende da una condizione (ad esempio
    // le preferenze dell'utente)

    Console.WriteLine($"{name} ha {age} anni.");
    // ancora meglio: anziché segnaposto numerici abbiamo dei segnaposto
    // che verranno interpretati con la sostituzione dei nomi di 
    // variabili con i valori degli stessi
    // così non è necessario elencare i parametri esplicitamente
    fmt = choice==0 ? $"{name} ha {age} anni." : $"Sono {age} gli anni di {name}.";
    Console.WriteLine(fmt);
    
	}
}
