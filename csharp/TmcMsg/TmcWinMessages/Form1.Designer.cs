namespace TmcMsg
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
            this.SendMessageButton = new System.Windows.Forms.Button();
            this.ContentTextBox = new System.Windows.Forms.TextBox();
            this.ContentLabel = new System.Windows.Forms.Label();
            this.RecipientLabel = new System.Windows.Forms.Label();
            this.RecipientsListBox = new System.Windows.Forms.ListBox();
            this.InfoLabel = new System.Windows.Forms.Label();
            this.GetMessagesButton = new System.Windows.Forms.Button();
            this.MessagesText = new System.Windows.Forms.TextBox();
            this.KeepMessagesCheckBox = new System.Windows.Forms.CheckBox();
            this.CleanUpButton = new System.Windows.Forms.Button();
            this.DeleteUnreadCheckBox = new System.Windows.Forms.CheckBox();
            this.SuspendLayout();
            // 
            // SendMessageButton
            // 
            this.SendMessageButton.Enabled = false;
            this.SendMessageButton.Location = new System.Drawing.Point(84, 162);
            this.SendMessageButton.Name = "SendMessageButton";
            this.SendMessageButton.Size = new System.Drawing.Size(232, 66);
            this.SendMessageButton.TabIndex = 0;
            this.SendMessageButton.Text = "Send Message";
            this.SendMessageButton.UseVisualStyleBackColor = true;
            this.SendMessageButton.Click += new System.EventHandler(this.SendMessageButton_Click);
            // 
            // ContentTextBox
            // 
            this.ContentTextBox.Location = new System.Drawing.Point(36, 126);
            this.ContentTextBox.Name = "ContentTextBox";
            this.ContentTextBox.Size = new System.Drawing.Size(325, 20);
            this.ContentTextBox.TabIndex = 1;
            this.ContentTextBox.Text = "Hello";
            // 
            // ContentLabel
            // 
            this.ContentLabel.AutoSize = true;
            this.ContentLabel.Location = new System.Drawing.Point(33, 101);
            this.ContentLabel.Name = "ContentLabel";
            this.ContentLabel.Size = new System.Drawing.Size(44, 13);
            this.ContentLabel.TabIndex = 2;
            this.ContentLabel.Text = "Content";
            // 
            // RecipientLabel
            // 
            this.RecipientLabel.AutoSize = true;
            this.RecipientLabel.Location = new System.Drawing.Point(33, 30);
            this.RecipientLabel.Name = "RecipientLabel";
            this.RecipientLabel.Size = new System.Drawing.Size(52, 13);
            this.RecipientLabel.TabIndex = 4;
            this.RecipientLabel.Text = "Recipient";
            // 
            // RecipientsListBox
            // 
            this.RecipientsListBox.FormattingEnabled = true;
            this.RecipientsListBox.Items.AddRange(new object[] {
            "tizio.alfa",
            "caio.beta"});
            this.RecipientsListBox.Location = new System.Drawing.Point(38, 55);
            this.RecipientsListBox.Name = "RecipientsListBox";
            this.RecipientsListBox.Size = new System.Drawing.Size(322, 30);
            this.RecipientsListBox.TabIndex = 5;
            this.RecipientsListBox.SelectedIndexChanged += new System.EventHandler(this.RecipientsListBox_SelectedIndexChanged);
            // 
            // InfoLabel
            // 
            this.InfoLabel.AutoSize = true;
            this.InfoLabel.Location = new System.Drawing.Point(449, 412);
            this.InfoLabel.Name = "InfoLabel";
            this.InfoLabel.Size = new System.Drawing.Size(0, 13);
            this.InfoLabel.TabIndex = 6;
            this.InfoLabel.Click += new System.EventHandler(this.InfoLabel_Click);
            // 
            // GetMessagesButton
            // 
            this.GetMessagesButton.Location = new System.Drawing.Point(619, 65);
            this.GetMessagesButton.Name = "GetMessagesButton";
            this.GetMessagesButton.Size = new System.Drawing.Size(232, 66);
            this.GetMessagesButton.TabIndex = 7;
            this.GetMessagesButton.Text = "Get Messages";
            this.GetMessagesButton.UseVisualStyleBackColor = true;
            this.GetMessagesButton.Click += new System.EventHandler(this.GetMessagesButton_Click);
            // 
            // MessagesText
            // 
            this.MessagesText.Location = new System.Drawing.Point(501, 137);
            this.MessagesText.Multiline = true;
            this.MessagesText.Name = "MessagesText";
            this.MessagesText.Size = new System.Drawing.Size(477, 215);
            this.MessagesText.TabIndex = 8;
            // 
            // KeepMessagesCheckBox
            // 
            this.KeepMessagesCheckBox.AutoSize = true;
            this.KeepMessagesCheckBox.Checked = true;
            this.KeepMessagesCheckBox.CheckState = System.Windows.Forms.CheckState.Checked;
            this.KeepMessagesCheckBox.Location = new System.Drawing.Point(619, 42);
            this.KeepMessagesCheckBox.Name = "KeepMessagesCheckBox";
            this.KeepMessagesCheckBox.Size = new System.Drawing.Size(184, 17);
            this.KeepMessagesCheckBox.TabIndex = 9;
            this.KeepMessagesCheckBox.Text = "Keep the messages on the server";
            this.KeepMessagesCheckBox.UseVisualStyleBackColor = true;
            // 
            // CleanUpButton
            // 
            this.CleanUpButton.Location = new System.Drawing.Point(84, 286);
            this.CleanUpButton.Name = "CleanUpButton";
            this.CleanUpButton.Size = new System.Drawing.Size(232, 66);
            this.CleanUpButton.TabIndex = 10;
            this.CleanUpButton.Text = "Clean Up";
            this.CleanUpButton.UseVisualStyleBackColor = true;
            this.CleanUpButton.Click += new System.EventHandler(this.CleanUpButton_Click);
            // 
            // DeleteUnreadCheckBox
            // 
            this.DeleteUnreadCheckBox.AutoSize = true;
            this.DeleteUnreadCheckBox.Location = new System.Drawing.Point(84, 263);
            this.DeleteUnreadCheckBox.Name = "DeleteUnreadCheckBox";
            this.DeleteUnreadCheckBox.Size = new System.Drawing.Size(165, 17);
            this.DeleteUnreadCheckBox.TabIndex = 11;
            this.DeleteUnreadCheckBox.Text = "Delete also unread messages";
            this.DeleteUnreadCheckBox.UseVisualStyleBackColor = true;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1018, 450);
            this.Controls.Add(this.DeleteUnreadCheckBox);
            this.Controls.Add(this.CleanUpButton);
            this.Controls.Add(this.KeepMessagesCheckBox);
            this.Controls.Add(this.MessagesText);
            this.Controls.Add(this.GetMessagesButton);
            this.Controls.Add(this.InfoLabel);
            this.Controls.Add(this.RecipientsListBox);
            this.Controls.Add(this.RecipientLabel);
            this.Controls.Add(this.ContentLabel);
            this.Controls.Add(this.ContentTextBox);
            this.Controls.Add(this.SendMessageButton);
            this.Name = "Form1";
            this.Text = "TMC Messenger";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button SendMessageButton;
        private System.Windows.Forms.TextBox ContentTextBox;
        private System.Windows.Forms.Label ContentLabel;
        private System.Windows.Forms.Label RecipientLabel;
        private System.Windows.Forms.ListBox RecipientsListBox;
        private System.Windows.Forms.Label InfoLabel;
        private System.Windows.Forms.Button GetMessagesButton;
        private System.Windows.Forms.TextBox MessagesText;
        private System.Windows.Forms.CheckBox KeepMessagesCheckBox;
        private System.Windows.Forms.Button CleanUpButton;
        private System.Windows.Forms.CheckBox DeleteUnreadCheckBox;
    }
}

