using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Net.Http;
using System.Net.Http.Headers;
using System.Runtime.Serialization.Json;
using System.IO;





namespace LDEAppWinForm
{
    public partial class Form1 : Form
    {
        private int _lastId;

        public Form1()
        {
            InitializeComponent();
        }

        private async void btnSaveJournalEntry_Click(object sender, EventArgs e)
        {
            // http://blog.stephencleary.com/2012/02/async-and-await.html
            prepareClient();
            int id = await PostJournalentry("[your slug here]");
            txtLog.AppendText("Call ended." + Environment.NewLine);
            txtLog.AppendText("Returned id: " + id.ToString());
        }

        private readonly HttpClient client = new HttpClient();

        private void prepareClient()
        {
            client.DefaultRequestHeaders.Accept.Clear();
            client.DefaultRequestHeaders.Add("User-Agent", ".NET Foundation LDE Client");
            String encoded = System.Convert.ToBase64String(System.Text.Encoding.GetEncoding("ISO-8859-1").GetBytes("apikey:[your api key here"));
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Basic", encoded);
        }

        private async Task<int> PostJournalentry(string slug)
        {
            string requestUrl = "https://learndoubleentry.org/api/journalentry/slug/" + slug;

            Journalentry je = new Journalentry();
            je.Date = "2019-01-07";
            je.Description = "Journal entry from dotnet / WinForm";

            je.Postings = new List<Posting>();

            Posting p1 = new Posting();
            p1.Code = "p.01.03";
            p1.Amount = 25.0;

            Posting p2 = new Posting();
            p2.Code = "p.02.01";
            p2.Amount = -25.0;

            je.Postings.Add(p1);
            je.Postings.Add(p2);

            txtLog.AppendText(je.Postings.Count.ToString());

            MemoryStream stream1 = new MemoryStream();
            DataContractJsonSerializer ser = new DataContractJsonSerializer(typeof(Firm));
            ser.WriteObject(stream1, je);

            stream1.Position = 0;
            StreamReader sr = new StreamReader(stream1);
            txtLog.AppendText("JSON form of Journalentry object: ");

            var jsonString = sr.ReadToEnd();

            txtLog.AppendText(jsonString + Environment.NewLine);

            txtLog.AppendText("Making request..." + Environment.NewLine);

            HttpContent httpContent = new StringContent(jsonString);
            httpContent.Headers.ContentType = new System.Net.Http.Headers.MediaTypeHeaderValue("application/json");

            //make the post request
            try
            {
                HttpResponseMessage hrm = await client.PostAsync(requestUrl, httpContent);

                txtLog.AppendText("Received response" + Environment.NewLine);

                txtLog.AppendText(hrm.StatusCode.ToString());

                var jsonResult = await hrm.Content.ReadAsStringAsync();
                txtLog.AppendText(jsonResult);

                var serializer = new DataContractJsonSerializer(typeof(JSONResult));

                var j = serializer.ReadObject(await hrm.Content.ReadAsStreamAsync()) as JSONResult;
                txtLog.AppendText(j.Status + Environment.NewLine);

                txtLog.AppendText(hrm.IsSuccessStatusCode.ToString() + Environment.NewLine);
                txtLog.AppendText(hrm.ReasonPhrase + Environment.NewLine);

                if (hrm.IsSuccessStatusCode)
                {
                    txtLog.AppendText("Success!" + Environment.NewLine);
                    txtLog.AppendText(j.Id.ToString() + Environment.NewLine);
                    return j.Id;
                }
                txtLog.AppendText("Something went wrong!" + Environment.NewLine);
                txtLog.AppendText(j.Explanation + Environment.NewLine);
                return -1;
            }
            catch (Exception ex)
            {
                txtLog.AppendText("Check your network..." + Environment.NewLine);
                return -2;
            }

        }




    }
}
