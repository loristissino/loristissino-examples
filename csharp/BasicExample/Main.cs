using System;

namespace BasicExample
{
	class IncreasingNumber
	{
		private int v;
		public IncreasingNumber()
		{
			v=0;
		}
		public void addValue(int x)
		{
			v+=x;
		}
		public int getValue()
		{
			return v;
		}
		
	}
	
	class MainClass
	{
		public static void Main (string[] args)
		{
			int n=0;
			
			IncreasingNumber inum = new IncreasingNumber();
			Console.WriteLine (string.Format("Valore corrente: {0}", inum.getValue()));
			
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
			inum.addValue(n);
			Console.WriteLine (string.Format("Valore corrente: {0}", inum.getValue()));
		}
	}
}
