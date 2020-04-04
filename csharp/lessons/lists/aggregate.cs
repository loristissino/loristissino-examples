using System;
using System.Collections.Generic;
using System.Linq;

class Student {
  public String Name;
  public int Age;
  public bool Valid;

  public Student(String name, int age, bool valid) {
    Name = name;
    Age = age;
    Valid = valid;
  }
}

class MainClass {
  public static void Main (string[] args) {
    List<Student> students = new List<Student>();
    students.Add(new Student("Alice", 20, true));
    students.Add(new Student("Bob", 18, true));
    students.Add(new Student("Charlie", 23, false));

    List<Student> validStudents = students.Where( x => x.Valid ).ToList();

    /*
    ageSum = 0;
    foreach (Student s in students) {
      if (s.Valid){
        ageSum += s.Age;
      }
    }
    */

    double ageAverage = validStudents.Aggregate(0, (acc, x) => acc + x.Age) / validStudents.Count;

    String allNames = students.Aggregate("", (acc, x) => acc + x.Name);

    Console.WriteLine(allNames);

  }
}
