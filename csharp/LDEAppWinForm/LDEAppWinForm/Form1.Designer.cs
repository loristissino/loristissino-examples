namespace LDEAppWinForm
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
            this.btnSaveJournalEntry = new System.Windows.Forms.Button();
            this.txtLog = new System.Windows.Forms.TextBox();
            this.SuspendLayout();
            // 
            // btnSaveJournalEntry
            // 
            this.btnSaveJournalEntry.Location = new System.Drawing.Point(139, 12);
            this.btnSaveJournalEntry.Name = "btnSaveJournalEntry";
            this.btnSaveJournalEntry.Size = new System.Drawing.Size(243, 50);
            this.btnSaveJournalEntry.TabIndex = 0;
            this.btnSaveJournalEntry.Text = "Save Journal Entry";
            this.btnSaveJournalEntry.UseVisualStyleBackColor = true;
            this.btnSaveJournalEntry.Click += new System.EventHandler(this.btnSaveJournalEntry_Click);
            // 
            // txtLog
            // 
            this.txtLog.Location = new System.Drawing.Point(69, 97);
            this.txtLog.Multiline = true;
            this.txtLog.Name = "txtLog";
            this.txtLog.Size = new System.Drawing.Size(384, 153);
            this.txtLog.TabIndex = 1;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(515, 262);
            this.Controls.Add(this.txtLog);
            this.Controls.Add(this.btnSaveJournalEntry);
            this.Name = "Form1";
            this.Text = "Form1";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btnSaveJournalEntry;
        private System.Windows.Forms.TextBox txtLog;
    }
}

