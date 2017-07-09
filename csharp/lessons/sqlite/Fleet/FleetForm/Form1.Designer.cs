namespace Fleet
{
    partial class Form1
    {
        /// <summary>
        /// Variabile di progettazione necessaria.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Pulire le risorse in uso.
        /// </summary>
        /// <param name="disposing">ha valore true se le risorse gestite devono essere eliminate, false in caso contrario.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Codice generato da Progettazione Windows Form

        /// <summary>
        /// Metodo necessario per il supporto della finestra di progettazione. Non modificare
        /// il contenuto del metodo con l'editor di codice.
        /// </summary>
        private void InitializeComponent()
        {
            this.VehiclesDGV = new System.Windows.Forms.DataGridView();
            this.id = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.color = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.self_driving = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            this.NewVehicleButton = new System.Windows.Forms.Button();
            this.VehiclePanel = new System.Windows.Forms.Panel();
            this.SaveButton = new System.Windows.Forms.Button();
            this.ColorLabel = new System.Windows.Forms.Label();
            this.ColorText = new System.Windows.Forms.TextBox();
            this.SelfDrivingCheckbox = new System.Windows.Forms.CheckBox();
            this.LogText = new System.Windows.Forms.TextBox();
            this.VehiclePKText = new System.Windows.Forms.TextBox();
            this.RetrieveButton = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.VehiclesDGV)).BeginInit();
            this.VehiclePanel.SuspendLayout();
            this.SuspendLayout();
            // 
            // VehiclesDGV
            // 
            this.VehiclesDGV.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.VehiclesDGV.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.id,
            this.color,
            this.self_driving});
            this.VehiclesDGV.Location = new System.Drawing.Point(21, 12);
            this.VehiclesDGV.MultiSelect = false;
            this.VehiclesDGV.Name = "VehiclesDGV";
            this.VehiclesDGV.Size = new System.Drawing.Size(407, 150);
            this.VehiclesDGV.TabIndex = 0;
            this.VehiclesDGV.RowHeaderMouseClick += new System.Windows.Forms.DataGridViewCellMouseEventHandler(this.VehiclesDGV_RowHeaderMouseClick);
            // 
            // id
            // 
            this.id.HeaderText = "Num.";
            this.id.Name = "id";
            this.id.ReadOnly = true;
            this.id.Visible = false;
            this.id.Width = 50;
            // 
            // color
            // 
            this.color.HeaderText = "Colore";
            this.color.Name = "color";
            this.color.ReadOnly = true;
            this.color.Width = 150;
            // 
            // self_driving
            // 
            this.self_driving.HeaderText = "Autom.?";
            this.self_driving.Name = "self_driving";
            this.self_driving.ReadOnly = true;
            this.self_driving.Width = 50;
            // 
            // NewVehicleButton
            // 
            this.NewVehicleButton.Location = new System.Drawing.Point(21, 183);
            this.NewVehicleButton.Name = "NewVehicleButton";
            this.NewVehicleButton.Size = new System.Drawing.Size(104, 24);
            this.NewVehicleButton.TabIndex = 1;
            this.NewVehicleButton.Text = "Nuovo Veicolo";
            this.NewVehicleButton.UseVisualStyleBackColor = true;
            this.NewVehicleButton.Click += new System.EventHandler(this.NewVehicleButton_Click);
            // 
            // VehiclePanel
            // 
            this.VehiclePanel.Controls.Add(this.SaveButton);
            this.VehiclePanel.Controls.Add(this.ColorLabel);
            this.VehiclePanel.Controls.Add(this.ColorText);
            this.VehiclePanel.Controls.Add(this.SelfDrivingCheckbox);
            this.VehiclePanel.Location = new System.Drawing.Point(28, 243);
            this.VehiclePanel.Name = "VehiclePanel";
            this.VehiclePanel.Size = new System.Drawing.Size(426, 171);
            this.VehiclePanel.TabIndex = 2;
            // 
            // SaveButton
            // 
            this.SaveButton.Location = new System.Drawing.Point(325, 135);
            this.SaveButton.Name = "SaveButton";
            this.SaveButton.Size = new System.Drawing.Size(75, 23);
            this.SaveButton.TabIndex = 3;
            this.SaveButton.Text = "Salva";
            this.SaveButton.UseVisualStyleBackColor = true;
            this.SaveButton.Click += new System.EventHandler(this.SaveButton_Click);
            // 
            // ColorLabel
            // 
            this.ColorLabel.AutoSize = true;
            this.ColorLabel.Location = new System.Drawing.Point(60, 55);
            this.ColorLabel.Name = "ColorLabel";
            this.ColorLabel.Size = new System.Drawing.Size(37, 13);
            this.ColorLabel.TabIndex = 2;
            this.ColorLabel.Text = "Colore";
            // 
            // ColorText
            // 
            this.ColorText.Location = new System.Drawing.Point(114, 52);
            this.ColorText.Name = "ColorText";
            this.ColorText.Size = new System.Drawing.Size(100, 20);
            this.ColorText.TabIndex = 1;
            // 
            // SelfDrivingCheckbox
            // 
            this.SelfDrivingCheckbox.AutoSize = true;
            this.SelfDrivingCheckbox.Location = new System.Drawing.Point(60, 26);
            this.SelfDrivingCheckbox.Name = "SelfDrivingCheckbox";
            this.SelfDrivingCheckbox.Size = new System.Drawing.Size(104, 17);
            this.SelfDrivingCheckbox.TabIndex = 0;
            this.SelfDrivingCheckbox.Text = "Guida autonoma";
            this.SelfDrivingCheckbox.UseVisualStyleBackColor = true;
            // 
            // LogText
            // 
            this.LogText.Location = new System.Drawing.Point(459, 15);
            this.LogText.Multiline = true;
            this.LogText.Name = "LogText";
            this.LogText.ScrollBars = System.Windows.Forms.ScrollBars.Vertical;
            this.LogText.Size = new System.Drawing.Size(218, 147);
            this.LogText.TabIndex = 3;
            // 
            // VehiclePKText
            // 
            this.VehiclePKText.Location = new System.Drawing.Point(176, 188);
            this.VehiclePKText.Name = "VehiclePKText";
            this.VehiclePKText.Size = new System.Drawing.Size(55, 20);
            this.VehiclePKText.TabIndex = 4;
            // 
            // RetrieveButton
            // 
            this.RetrieveButton.Location = new System.Drawing.Point(255, 186);
            this.RetrieveButton.Name = "RetrieveButton";
            this.RetrieveButton.Size = new System.Drawing.Size(98, 21);
            this.RetrieveButton.TabIndex = 5;
            this.RetrieveButton.Text = "Carica Veicolo";
            this.RetrieveButton.UseVisualStyleBackColor = true;
            this.RetrieveButton.Click += new System.EventHandler(this.RetrieveButton_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(707, 433);
            this.Controls.Add(this.RetrieveButton);
            this.Controls.Add(this.VehiclePKText);
            this.Controls.Add(this.LogText);
            this.Controls.Add(this.VehiclePanel);
            this.Controls.Add(this.NewVehicleButton);
            this.Controls.Add(this.VehiclesDGV);
            this.Name = "Form1";
            this.Text = "Flotta aziendale";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.VehiclesDGV)).EndInit();
            this.VehiclePanel.ResumeLayout(false);
            this.VehiclePanel.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.DataGridView VehiclesDGV;
        private System.Windows.Forms.Button NewVehicleButton;
        private System.Windows.Forms.Panel VehiclePanel;
        private System.Windows.Forms.Button SaveButton;
        private System.Windows.Forms.Label ColorLabel;
        private System.Windows.Forms.TextBox ColorText;
        private System.Windows.Forms.CheckBox SelfDrivingCheckbox;
        private System.Windows.Forms.TextBox LogText;
        private System.Windows.Forms.TextBox VehiclePKText;
        private System.Windows.Forms.Button RetrieveButton;
        private System.Windows.Forms.DataGridViewTextBoxColumn id;
        private System.Windows.Forms.DataGridViewTextBoxColumn color;
        private System.Windows.Forms.DataGridViewCheckBoxColumn self_driving;
    }
}

