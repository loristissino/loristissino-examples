using System;

namespace BasicExample
{
	class MainClass
	{
		public static void Main (string[] args)
		{
			int n=0;
			Console.WriteLine ("Inserisci un numero:");
			
			string s;
			bool done=false;
			while (!done)
			{
				s=Console.ReadLine();
				try
				{
					n=int.Parse(s);
					done=true;
				}
				catch (Exception e)
				{
					Console.WriteLine("Input non valido");
				}
			}
			Console.WriteLine (string.Format("Numero inserito: {0}", n));
		}
	}
}
