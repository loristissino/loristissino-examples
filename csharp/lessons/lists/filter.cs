using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication1
{
  class Person
  {
    private string _name;
    private int _age;
    private bool _isMale;
    
    public Person(string name, char gender, int age)
    {
      Name = name;
      Gender = gender;
      Age = age;
    }
    
    public string Name
    {
      get { return _name; }
      set { _name = value==""? "ANONYMOUS": value; }
    }
    
    public int Age
    {
      get { return _age; }
      set { _age = value<0? 0 :value; }
    }
    
    public char Gender
    {
      get { return _isMale? 'M': 'F'; }
      set { 
        if (value=='M')
          _isMale=true;
        else if (value=='F')
          _isMale=false; 
        else
          throw new Exception("Wrong call");
      }
    }

    public override string ToString()
    {
      return string.Format("{0}, {1}, {2} years old", Name, Gender, Age); 
    }
  }

  class Program
  {

    public static List<Person> people;
    
    static void showPersons(List<Person> persons, string title)
    {
      Console.WriteLine(title);
      foreach (Person person in persons)
      {
        Console.WriteLine(person);
      }
      Console.WriteLine("-------------");
    }
    
    static void Main(string[] args)
    {
      people = new List<Person>();
      people.Add(new Person("John", 'M', 20));
      people.Add(new Person("Peter", 'M', 16));
      people.Add(new Person("Anna", 'F', 18));
      people.Add(new Person("Marc", 'M', 17));
      showPersons(people, "Complete list");
      
      List<Person> males;
      males = people.Where(x => x.Gender=='M').ToList();
      showPersons(males, "Males");
      
      showPersons(people.Where(x => x.Gender=='F').ToList(), "Females");
      showPersons(people.Where(x => x.Age<18).ToList(), "Under Age");
      
    }
  }
}
