using System;
using System.Globalization; // add this line 

class Parser {
    static void Main(string[] args) {
      double v;
      String s;
      
      s = "3,25";
      v = Double.Parse(s, new CultureInfo("it"));
      Console.WriteLine(v); // 3.25

      s = "3.25";
      v = Double.Parse(s, new CultureInfo("en"));
      Console.WriteLine(v); // 3.25
    }
}

