using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SQLite;
using System.Configuration;

namespace Fleet
{
    class Vehicle
    {
        public static SQLiteConnection dbC;
        public static string Firm;
        private static int _count=0;

        private string _color;
        private bool _selfDriving;

        private int _pk;

        public static int Count
        {
            get { return _count; }
        }

        public int Pk
        {
            get
            {
                return _pk;
            }
        }

        public bool IsNew
        {
            get
            {
                return Pk < 0;
            }

        }

        public string Color {
            get
            {
                return _color;
            }
            set
            {
                if (value.Length >= 3)
                    _color = value;
                else
                    throw new Exception("Invalid color");
            }
        }

        public bool SelfDriving
        {
            get
            {
                return _selfDriving;
            }
            set
            {
                _selfDriving = value;
            }

        }

        public bool setSelfDriving(string value)
        {
            if ("tTvV1sSyY".Contains(value))
               _selfDriving = true;
            else if ("fF0nN".Contains(value))
               _selfDriving = false;
            else
               throw new Exception("Invalid value");
            return SelfDriving;
        }

        public Vehicle()
        {
            Color = "White";
            _init();
        }

        public Vehicle(string color)
        {
            Color = color;
            _init();
        }

        private void _init()
        {
            _count++;
            _pk = -1;
        }

        public void Save()
        {
            string sql;
            SQLiteCommand command;

            command = new SQLiteCommand();
            command.Connection = dbC;

            command.Parameters.AddWithValue("@color", Color);
            command.Parameters.AddWithValue("@self_driving", SelfDriving);

            if (IsNew)
            {
                sql = "INSERT INTO vehicles (color, self_driving) VALUES (@color, @self_driving)";
            }
            else
            {
                sql = "UPDATE vehicles SET color=@color, self_driving=@self_driving WHERE rowid=@pk";
                command.Parameters.AddWithValue("@pk", Pk);
            }

            command.CommandText = sql;

            command.ExecuteNonQuery();
         }

        public static Vehicle RetrieveByPk(int pk)
        {
            Vehicle v=null;

            string sql;
            SQLiteCommand command;

            sql = "SELECT rowid, color, self_driving FROM vehicles where rowid=@pk";
            command = new SQLiteCommand(sql, dbC);
            command.Parameters.AddWithValue("@pk", pk);

            SQLiteDataReader reader = command.ExecuteReader();
            if (reader.Read())
            {
                v = new Vehicle();
                v._pk = Convert.ToInt32(reader["rowid"]);
                v.Color = reader["color"].ToString();
                v.SelfDriving = Convert.ToBoolean(reader["self_driving"]);
            }
            return v;
        }
        public static List<Vehicle> RetrieveAll()
        {
            List<Vehicle> l = new List<Vehicle>();
            Vehicle v = null;

            string sql;
            SQLiteCommand command;

            sql = "SELECT rowid, color, self_driving FROM vehicles";
            command = new SQLiteCommand(sql, dbC);

            SQLiteDataReader reader = command.ExecuteReader();
            while (reader.Read())
            {
                v = new Vehicle();
                v._pk = Convert.ToInt32(reader["rowid"]);
                v.Color = reader["color"].ToString();
                v.SelfDriving = Convert.ToBoolean(reader["self_driving"]);
                l.Add(v);
            }
            return l;
        }
    }
}
