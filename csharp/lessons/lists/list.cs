using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication1
{
  class PartnershipEvent
  {
    private DateTime _date;
    private string _description;
    
    public PartnershipEvent(DateTime date, string description)
    {
      _date = date;
      _description = description;
    }
    
    public DateTime date
    {
      get { return _date; }
    }
    
    public string description
    {
      get { return _description; }
    }

    public override string ToString()
    {
      return string.Format("{0}: {1}", _date.ToString("dd/MM/yyyy"), _description); 
    }
  }

  class Program
  {

    public static List<PartnershipEvent> events;
    
    static void showEvents(string title)
    {
      Console.WriteLine(title);
      foreach (PartnershipEvent partnershipEvent in events)
      {
        Console.WriteLine(partnershipEvent);
      }
      Console.WriteLine("{0} elementi presenti nell'elenco di eventi", events.Count);
      Console.WriteLine("-------------");
    }
    
    static void Main(string[] args)
    {
      events = new List<PartnershipEvent>();
      events.Add(new PartnershipEvent(new DateTime(2011, 10, 20), "Costituzione"));
      events.Add(new PartnershipEvent(new DateTime(2012, 02, 21), "Conferimento"));
      events.Add(new PartnershipEvent(new DateTime(2011, 11, 21), "Conferimento"));
      events.Add(new PartnershipEvent(new DateTime(2011, 10, 23), "Ingresso nuovo socio"));
      events.Add(new PartnershipEvent(new DateTime(2013, 10, 24), "Uscita socio"));
      
      showEvents("Lista iniziale");

      events.Sort( (a, b) => a.date.CompareTo(a.date) );
      showEvents("Lista ordinata per data");

      events.Sort( (a, b) => b.date.CompareTo(a.date) );
      showEvents("Lista ordinata per data, in ordine inverso");

      events.Sort( (a, b) => b.description.CompareTo(a.description) );
      showEvents("Lista ordinata per descrizione");

      events.RemoveAt(1);
      showEvents("Lista con un elemento rimosso");
      
    }
  }
}
