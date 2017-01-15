using System;
public class Program
{
    public static string mix(string a, string b)
    {
      string s="";
      for (int i=0; i<Math.Max(a.Length, b.Length); i++)
      {
        if (i<a.Length && i%2==0 || i>=b.Length)
          s+=a[i];
        else
          s+=b[i];
      }
      return s;
    }

    public static void Main()
    {
      Console.WriteLine(mix("", "abc"));
      Console.WriteLine("abc");
      Console.WriteLine(mix("ABC", ""));
      Console.WriteLine("ABC");
      Console.WriteLine(mix("ABC", "abc"));
      Console.WriteLine("AbC");
      Console.WriteLine(mix("ABCDEF", "abc"));
      Console.WriteLine("AbCDEF");
      Console.WriteLine(mix("ABCDEF", "abcd"));
      Console.WriteLine("AbCdEF");
      Console.WriteLine(mix("ABCD", "abcdefgh"));
      Console.WriteLine("AbCdefgh");
    }
}
