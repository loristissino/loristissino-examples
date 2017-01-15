using System;
public class Program
{
    public static string compare(string a, string b)
    {
      return a==b ? "OK": "FAILED";
    }
  
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
      Console.WriteLine(compare(mix("", "abc"), "abc"));
      Console.WriteLine(compare(mix("ABC", ""), "ABC"));
      Console.WriteLine(compare(mix("ABC", "abc"), "AbC"));
      Console.WriteLine(compare(mix("ABCDEF", "abc"), "AbCDEF"));
      Console.WriteLine(compare(mix("ABCDEF", "abcd"), "AbCdEF"));
      Console.WriteLine(compare(mix("ABCD", "abcdefgh"), "AbCdefgh"));
    }
}
