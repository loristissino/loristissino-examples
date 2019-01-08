using System;
using System.Runtime.Serialization;
using System.Collections.Generic;

using System.Globalization;

namespace LDEAppWinForm
{
    [DataContract(Name = "JSONResult")]
    public class JSONResult
    {
        [DataMember(Name = "http_code")]
        public int HttpCode { get; set; }

        [DataMember(Name = "status")]
        public string Status { get; set; }

        [DataMember(Name = "id")]
        public int Id { get; set; }

        [DataMember(Name = "explanation")]
        public string Explanation { get; set; }
    }
}
