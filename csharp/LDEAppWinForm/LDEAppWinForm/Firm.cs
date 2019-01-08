using System;
using System.Runtime.Serialization;
using System.Globalization;

namespace LDEAppWinForm
{
    [DataContract(Name = "firm")]
    public class Firm
    {
        /*
        private string _name;

        [DataMember(Name="name")]
        public string Name 
        { 
            get { return this._name; }
            set { this._name = value; }
        }
        */
        [DataMember(Name = "slug")]
        public string Slug { get; set; }

        [DataMember(Name = "name")]
        public string Name { get; set; }

        [DataMember(Name = "currency")]
        public string Currency { get; set; }

    }
}