using System.Data;
using System.Data.SqlClient;

// This example assumes the existance of a database called Library2023 with a table called
// "books" with fields "id" and "title".

namespace DatabaseAccessTest
{
    internal class Program
    {
        static void Main(string[] args)
        {
            SqlConnection cnn;
            string connectionString = @"Server=localhost\SQLEXPRESS;Database=Library2023;User Id=sa;Password=Password1;";

            ReadExample01(connectionString);

            cnn = new SqlConnection(connectionString);
            cnn.Open();

            ReadExample02(cnn);
            ReadExample03(cnn);
            ReadExample04(cnn);
            ReadExample05(cnn);

            //WriteExample01(cnn);
            //WriteExample02(cnn);

            //UpdateExample01(cnn);
            //DeleteExample01(cnn);

            cnn.Close();

            Console.ReadLine();
        }



        static void ReadExample01(string connectionString)
        {
            SqlCommand command;
            SqlDataReader reader;
            string sql, output = "";

            Console.WriteLine("Read Example 01");
            using (SqlConnection cnn = new SqlConnection(connectionString))
            {
                cnn.Open();
                sql = "SELECT * FROM books";
                command = new SqlCommand(sql, cnn);
                Console.WriteLine(command.CommandText);
                reader = command.ExecuteReader();
                while (reader.Read())
                {
                    output += reader.GetValue(1) + Environment.NewLine;
                }
                Console.Write(output);
                reader.Close();
                command.Dispose();
            }
        }

        static void ReadExample02(SqlConnection cnn)
        {
            SqlCommand command;
            SqlDataReader reader;
            string sql, output = "";

            sql = "SELECT * FROM books";
            command = new SqlCommand(sql, cnn);
            reader = command.ExecuteReader();

            Console.WriteLine("Read Example 02");

            while (reader.Read())
            {
                output +=reader.GetValue(1) + Environment.NewLine;
            }

            Console.Write(output);

            reader.Close();
            command.Dispose();
        }

        static void ReadExample03(SqlConnection cnn)
        {
            SqlCommand command;
            SqlDataReader reader;
            string sql, output = "";

            sql = "SELECT * FROM books";
            command = new SqlCommand(sql, cnn);
            reader = command.ExecuteReader();

            Console.WriteLine("Read Example 03");

            while (reader.Read())
            {
                output += reader.GetName(1) + ": " + reader.GetValue(1) + Environment.NewLine;
            }
            Console.Write(output);

            reader.Close();
            command.Dispose();
        }

        static void ReadExample04(SqlConnection cnn)
        {
            SqlCommand command;
            SqlDataReader reader;
            string sql, output = "";

            sql = "SELECT * FROM books";
            command = new SqlCommand(sql, cnn);
            reader = command.ExecuteReader();

            Console.WriteLine("Read Example 04");

            while (reader.Read())
            {
                for (int i=0; i<reader.FieldCount; i++)
                {
                    output += reader.GetName(i) + ": " + reader.GetValue(i) + Environment.NewLine;
                }
                output += Environment.NewLine;
            }
            Console.Write(output);
            reader.Close();
            command.Dispose();
        }

        static void ReadExample05(SqlConnection cnn)
        {
            SqlCommand command;
            SqlDataReader reader;
            string sql, output = "";

            sql = "SELECT * FROM books WHERE id >= @minId";
            command = new SqlCommand(sql, cnn);

            command.Parameters.Add("@minId", SqlDbType.Int);
            command.Parameters["@minId"].Value = 3;

            reader = command.ExecuteReader();

            Console.WriteLine("Read Example 05");

            while (reader.Read())
            {
                for (int i = 0; i < reader.FieldCount; i++)
                {
                    output += reader.GetName(i) + ": " + reader.GetValue(i) + Environment.NewLine;
                }
                output += Environment.NewLine;
            }
            Console.Write(output);
            reader.Close();
            command.Dispose();
        }

        static void WriteExample01(SqlConnection cnn)
        {
            SqlCommand command;

            SqlDataAdapter adapter = new SqlDataAdapter();

            Console.WriteLine("Write Example 01");

            string sql = "INSERT INTO books(title) VALUES ('The Marvels of Software Development')";

            command = new SqlCommand(sql, cnn);

            adapter.InsertCommand = command;

            int affectedRows = adapter.InsertCommand.ExecuteNonQuery();

            Console.WriteLine($"Wrote {affectedRows} rows!");

            adapter.Dispose();
            command.Dispose();
        }

        static void WriteExample02(SqlConnection cnn)
        {
            SqlCommand command;

            SqlDataAdapter adapter = new SqlDataAdapter();

            Console.WriteLine("Write Example 02");

            string sql = "INSERT INTO books(title) VALUES (@title)";

            command = new SqlCommand(sql, cnn);

            command.Parameters.Add("@title", SqlDbType.VarChar);
            command.Parameters["@title"].Value = "The Magic of Testing";

            adapter.InsertCommand = command;

            int affectedRows = adapter.InsertCommand.ExecuteNonQuery();

            Console.WriteLine($"Wrote {affectedRows} rows!");

            adapter.Dispose();
            command.Dispose();
        }

        static void UpdateExample01(SqlConnection cnn)
        {
            SqlCommand command;

            SqlDataAdapter adapter = new SqlDataAdapter();

            Console.WriteLine("Update Example 01");

            string sql = "UPDATE books SET title = CONCAT(title, '*') WHERE id >= @minId";

            command = new SqlCommand(sql, cnn);

            command.Parameters.Add("@minId", SqlDbType.Int);
            command.Parameters["@minId"].Value = 3;

            adapter.UpdateCommand = command;

            int affectedRows = adapter.UpdateCommand.ExecuteNonQuery();

            Console.WriteLine($"Updated {affectedRows} rows!");

            adapter.Dispose();
            command.Dispose();
        }

        static void DeleteExample01(SqlConnection cnn)
        {
            SqlCommand command;

            SqlDataAdapter adapter = new SqlDataAdapter();

            Console.WriteLine("Delete Example 01");

            string sql = "DELETE FROM books WHERE id = @id";

            command = new SqlCommand(sql, cnn);

            command.Parameters.Add("@id", SqlDbType.Int);
            command.Parameters["@id"].Value = 6;

            adapter.DeleteCommand = command;

            int affectedRows = adapter.DeleteCommand.ExecuteNonQuery();

            Console.WriteLine($"Deleted {affectedRows} rows!");

            adapter.Dispose();
            command.Dispose();
        }


    }
}