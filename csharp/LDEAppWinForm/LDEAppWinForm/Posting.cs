using System;
using System.Runtime.Serialization;
using System.Collections.Generic;

using System.Globalization;

namespace LDEAppWinForm
{
    [DataContract(Name = "posting")]
    public class Posting
    {
        [DataMember(Name = "code")]
        public string Code { get; set; }

        [DataMember(Name = "amount")]
        public double Amount { get; set; }

        [DataMember(Name = "comment")]
        public string Comment { get; set; }

        [DataMember(Name = "subchoice")]
        public string Subchoice { get; set; }
    }
}