using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SQLite;
using System.Configuration;

namespace FriendsSqlite
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine(ConfigurationManager.AppSettings.Get("dbConnectionString"));

            SQLiteConnection dbC;
            dbC = new SQLiteConnection(ConfigurationManager.AppSettings.Get("dbConnectionString"));
            //SQLiteConnection.CreateFile("MyDatabase.sqlite");
            dbC.Open();

            string sql;
            SQLiteCommand command;
            
            /*
            sql = "SELECT * FROM friends order by name asc";
            command = new SQLiteCommand(sql, dbC);
            SQLiteDataReader reader = command.ExecuteReader();
            while (reader.Read())
                Console.WriteLine("Name: {0}, City: {1}", reader["name"], reader["city"]);
            */

            string name = "Michele";
            string city = "Treviso";

            command = new SQLiteCommand("INSERT INTO friends (name, city) VALUES (@name,@city)", dbC);
            command.Parameters.AddWithValue("@name", name);
            command.Parameters.AddWithValue("@city", city);
            try {
                command.ExecuteNonQuery();
                Console.WriteLine("Inserimento riuscito");
            }
            catch (Exception ex) {
                Console.WriteLine("Inserimento non riuscito");
            }

            sql = "SELECT * FROM friends where city=@city order by name asc";
            command = new SQLiteCommand(sql, dbC);
            command.Parameters.AddWithValue("@city", "Pordenone");
            
            SQLiteDataReader reader = command.ExecuteReader();
            while (reader.Read())
                Console.WriteLine("Name: {0}, City: {1}", reader["name"], reader["city"]);



            dbC.Close();
            Console.ReadLine();
        }
    }
}


