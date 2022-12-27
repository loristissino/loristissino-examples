using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TmcMsg
{
    internal class TmcMessage
    {
        public int TimeStamp;
        public string UserName = "";
        public string Sender = "";
        public string Content = "";

        public DateTime SentAt
        {
            get { return DateTimeOffset.FromUnixTimeSeconds(TimeStamp).UtcDateTime; }
        }

        public override string ToString()
        {
            return $"{SentAt:yyyy-MM-dd HH:mm:ss} -- {Sender} <{UserName}> -- {Content}";
        }
    }
}
