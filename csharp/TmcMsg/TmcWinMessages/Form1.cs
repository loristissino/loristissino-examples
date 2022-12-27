using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace TmcMsg
{
    public partial class Form1 : Form
    {
        TmcMessenger messenger = new TmcMessenger("385545561214");

        public Form1()
        {
            InitializeComponent();
        }

        private async void SendMessageButton_Click(object sender, EventArgs e)
        {
            InfoLabel.Text = "Sending...";
            string recipient = RecipientsListBox.SelectedItem.ToString();
            string content = ContentTextBox.Text;
            bool sent = await messenger.SendMessage(recipient, content);
            InfoLabel.Text = sent ? "Sent!": "Not sent!";

        }

        private void InfoLabel_Click(object sender, EventArgs e)
        {
            InfoLabel.Text = "";
        }

        private void RecipientsListBox_SelectedIndexChanged(object sender, EventArgs e)
        {
            SendMessageButton.Enabled = true;
        }

        private async void GetMessagesButton_Click(object sender, EventArgs e)
        {
            InfoLabel.Text = "Retrieving messages...";
            List<TmcMessage> messages = await messenger.GetMessages(KeepMessagesCheckBox.Checked);
            MessagesText.Clear();
            InfoLabel.Text = "Messages retrieved!";
            foreach (TmcMessage message in messages)
            {
                MessagesText.Text += message + Environment.NewLine;
            }
        }

        private async void CleanUpButton_Click(object sender, EventArgs e)
        {
            InfoLabel.Text = "Deleting messages...";
            int DeletionCount = await messenger.CleanUp(DeleteUnreadCheckBox.Checked);
            InfoLabel.Text = $"{DeletionCount} message(s) deleted!";
        }
    }
}
