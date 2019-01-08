using System;
using System.Runtime.Serialization;
using System.Collections.Generic;

using System.Globalization;

namespace LDEAppWinForm
{
    [DataContract(Name = "journalentry")]
    [KnownType(typeof(Journalentry))]
    [KnownType(typeof(List<object>))]
    [KnownType(typeof(List<Posting>))]
    [KnownType(typeof(Posting))]
    public class Journalentry
    {
        [DataMember(Name = "id")]
        public int Id { get; set; }

        [DataMember(Name = "description")]
        public string Description { get; set; }

        [DataMember(Name = "date")]
        public string Date { get; set; }

        [DataMember(Name = "section_id")]
        public int SectionId { get; set; }

        [DataMember(Name = "postings")]
        public List<Posting> Postings { get; set; }

    }
}