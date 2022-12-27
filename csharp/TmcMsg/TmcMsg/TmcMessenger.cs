using System;
using System.Threading.Tasks;
using System.Net;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Collections.Generic;

namespace TmcMsg
{
    /// <summary>
    /// Class <c>TmcMessenger</c> represents a TestMyCode Messenger Client.
    /// </summary>
    internal class TmcMessenger
    {
        /// <summary>
        /// Instance static variable representing the HTTP client.
        /// </summary>
        /// <remarks>
        /// Static and readonly because we want only one instance of the client.
        /// </remarks>
        static readonly HttpClient client = new HttpClient();

        /// <summary>
        /// The entry point for the HTTPS connections.
        /// </summary>
        private const string _entryPoint = "https://example.com/messages";

        /// <summary>
        /// The token identifying the user (via the "Authorization: Bearer" HTTP field).
        /// </summary>
        private string _token = "";

        /// <summary>
        /// This constructor initializes the messenger with the user token.
        /// </summary>
        public TmcMessenger(string token)
        {
            Token = token;
        }

        /// <summary>
        /// The property representing the token.
        /// </summary>
        public string Token {
            get { return _token; }
            set { _token = value; }
        }

        /// <summary>
        /// Retrieves the messages.
        /// </summary>
        /// <param name="keep">whether the read messages should be kept in the server databaase.</param>
        /// <returns>
        /// A deferred list of <c>TmcMessage</c>s (empty if none).
        /// </returns>
        public async Task<List<TmcMessage>> GetMessages(bool keep = false)
        {
            string responseBody;
            HttpResponseMessage response;
            SetAuthorizationHeader();
            List<TmcMessage> messages = new List<TmcMessage>();
            
            try
            {
                string k = keep ? "true" : "false";
                response = await client.GetAsync($"{_entryPoint}/get?keep={k}");

                if (response.StatusCode == HttpStatusCode.OK)
                {
                    responseBody = await response.Content.ReadAsStringAsync();
                    string[] lines = responseBody.Split('\n');
                    // One message for each line
                    foreach (string line in lines)
                    {
                        string[] parts = line.Split('\t');
                        // One field for each field, tab separated
                        messages.Add(new TmcMessage
                        {
                            TimeStamp = int.Parse(parts[0]),
                            UserName = parts[1],
                            Sender = parts[2],
                            Content = parts[3]
                        });
                    }
                }

            }
            catch (HttpRequestException e)
            {
                // The list of messages will be empty
                // TODO Log somewhere?
            }
            return messages;
        }

        /// <summary>
        /// Sends a message.
        /// </summary>
        /// <param name="recipient">the username of the recipient.</param>
        /// <param name="content">the content of the message.</param>
        /// <returns>
        /// A deferred boolean (true if the message was correctly acquired by the server).
        /// </returns>
        public async Task<bool> SendMessage(string recipient, string content)
        {
            string responseBody;
            HttpResponseMessage response;
            SetAuthorizationHeader();
            try
            {
                response = await client.PostAsync(
                    $"{_entryPoint}/send?to={recipient}",
                    new StringContent(content)
                );
                response.EnsureSuccessStatusCode();
                responseBody = await response.Content.ReadAsStringAsync();
                return true;
            }
            catch (HttpRequestException e)
            {
                return false;
            }
        }

        /// <summary>
        /// Cleans up the list of sent messages on the server.
        /// </summary>
        /// <param name="unread">whether unread messages should be deleted too.</param>
        /// <returns>
        /// A deferred int, representing the number of messages deleted (-1 in case of communication errors).
        /// </returns>
        public async Task<int> CleanUp(bool unread = false)
        {
            string responseBody;
            HttpResponseMessage response;
            SetAuthorizationHeader();
            try
            {
                string u = unread ? "true" : "false";
                response = await client.PostAsync($"{_entryPoint}/clean-up?unread={u}", null);
                response.EnsureSuccessStatusCode();
                responseBody = await response.Content.ReadAsStringAsync();
                return int.Parse(responseBody);
            }
            catch (HttpRequestException e)
            {
                return -1;
            }
        }

        /// <summary>
        /// Sets the user token in the "Authorization: Bearer" HTTP header.
        /// </summary>
        private void SetAuthorizationHeader() {
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", _token);
        }

    }
}
