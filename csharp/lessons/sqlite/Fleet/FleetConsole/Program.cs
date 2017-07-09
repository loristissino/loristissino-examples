using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SQLite;
using System.Configuration;

namespace Fleet
{
    class Program
    {

        static SQLiteConnection dbC;

        static void Main(string[] args)
        {


            dbC = new SQLiteConnection(ConfigurationManager.AppSettings.Get("dbConnectionString"));
            dbC.Open();
            Vehicle.dbC = dbC;

            Vehicle.Firm = ConfigurationManager.AppSettings.Get("firmName");

            Console.Title = "Fleet Manager - " + Vehicle.Firm;
            Console.WindowWidth = 40;

            string color = "V"; // simula l'input dell'utente

            Vehicle f = new Vehicle();
            

            f.setSelfDriving("F");  // F, N, 0  --> false
                                  // Y, V, T, 1 --> true

            Console.WriteLine(f.SelfDriving);

            try
            {
                f.Color = color;
            }
            catch
            {
                //f.Color = "";
                Console.WriteLine("Colore impostato non valido; lasciato il precedente.");
            }
            
            // better ask for forgiveness than permission

            Console.WriteLine(f.Color);
            //f._color = color;

            Console.WriteLine(Vehicle.Count);

            Vehicle k = new Vehicle("Giallo");
            Console.WriteLine(k.Color);

            Console.WriteLine(Vehicle.Count);

            Console.WriteLine("Elenco veicoli:");
            foreach (Vehicle v in Vehicle.RetrieveAll())
            {
                Console.WriteLine(v.Pk + " - " + v.Color);
            }

            int pk = 0;
            while (pk!=-1)
            {
                Console.WriteLine("Inserisci un codice:");
                try
                {
                    pk = Convert.ToInt32(Console.ReadLine());
                }
                catch
                {
                    pk = -1;
                }
                if (pk !=-1)
                {
                    Vehicle v = Vehicle.RetrieveByPk(pk);
                    if (v is Vehicle)
                    {
                        Console.WriteLine(v.Color + " (" + (v.SelfDriving ? "guida automatica" : "guida normale") + ")");
                    }
                    else
                    {
                        Console.WriteLine("Veicolo non trovato");
                    }
                }


            }

            Console.WriteLine("Esecuzione terminata. Premere invio per uscire.");
            Console.ReadLine();
        }
    }
}
