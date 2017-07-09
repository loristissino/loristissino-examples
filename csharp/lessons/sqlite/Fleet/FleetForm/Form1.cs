using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SQLite;
using System.Configuration;

namespace Fleet
{
    public partial class Form1 : Form
    {

        SQLiteConnection dbC;
        Vehicle v;

        public Form1()
        {
            InitializeComponent();
            try
            {
                dbC = new SQLiteConnection(ConfigurationManager.AppSettings.Get("dbConnectionString"));
                dbC.Open();
                Vehicle.dbC = dbC;
                Vehicle.Firm = ConfigurationManager.AppSettings.Get("firmName");
                this.Text += " - " + Vehicle.Firm;
                //AddToLog(dbC.State.ToString());
            }
            catch (Exception ex)
            {
                AddToLog("Connessione al db non riuscita");
                AddToLog(ex.Message);
                //AddToLog(dbC.State.ToString());
            }
            // istruzioni per l'accesso ai dati

            // dbC.Close();


        }



        private void Form1_Load(object sender, EventArgs e)
        {
            LoadVehicles();
            VehiclePanel.Hide();
        }

        private void NewVehicleButton_Click(object sender, EventArgs e)
        {
            VehiclePanel.Show();
        }

        private void SaveButton_Click(object sender, EventArgs e)
        {
            try
            {
                if (!(v is Vehicle))
                {
                    v = new Vehicle();
                }
                v.Color = ColorText.Text;
                v.SelfDriving = SelfDrivingCheckbox.Checked;
                v.Save();
                AddToLog("Creato e salvato veicolo " + v.Color + v.SelfDriving);
                //AddToLog(Vehicle.Count);
                VehiclePanel.Hide();

                // Le istruzioni di inizializzazione dei campi
                // dovrebbero essere messe in una apposita funzione
                ColorText.Clear();
                SelfDrivingCheckbox.Checked = false;


                LoadVehicles();
                v = null;
            }
            catch (Exception ex)
            {
                AddToLog("Errore: " + ex.Message);
            }

        }

        private void RetrieveButton_Click(object sender, EventArgs e)
        {
            int pk = Convert.ToInt32(VehiclePKText.Text);
            v = Vehicle.RetrieveByPk(pk);
            if (v is Vehicle)
            {
                AddToLog(v.Pk + " " + v.Color + " " + v.SelfDriving+ Environment.NewLine);
            }
            else
            {
                AddToLog("Veicolo non trovato");
            }
        }

        public void LoadVehicles()
        {
            AddToLog("Elenco veicoli:");

            VehiclesDGV.Rows.Clear();
            int rows = 0;

            foreach (Vehicle v in Vehicle.RetrieveAll())
            {
                AddToLog(v.Color);
                VehiclesDGV.Rows.Add();

                // Le istruzioni per popolare una riga
                // potrebbero essere messe in una apposita funzione

                VehiclesDGV.Rows[rows].Cells["id"].Value = v.Pk.ToString();
                VehiclesDGV.Rows[rows].Cells["color"].Value = v.Color;
                VehiclesDGV.Rows[rows].Cells["self_driving"].Value = v.SelfDriving;
                rows++;
            }
        }

        public void AddToLog(string s)
        {
            LogText.AppendText(s + Environment.NewLine);
        }

        private void VehiclesDGV_RowHeaderMouseClick(object sender, DataGridViewCellMouseEventArgs e)
        {
            int vehicleId;
            vehicleId = Convert.ToInt32(VehiclesDGV.SelectedRows[0].Cells["id"].Value);
            AddToLog(vehicleId.ToString());

            v = Vehicle.RetrieveByPk(vehicleId);

            if (v is Vehicle)
            {
                AddToLog(v.Pk + " " + v.Color + " " + v.SelfDriving + Environment.NewLine);
                ColorText.Text = v.Color;
                SelfDrivingCheckbox.Checked = v.SelfDriving;
                VehiclePanel.Show();
            }
            else
            {
                AddToLog("Veicolo non trovato");
            }
        }
    }
}
