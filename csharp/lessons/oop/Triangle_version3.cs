using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TriangleManager
{
    class Triangle
    {
        float s1;
        float s2;
        float s3;

        public Triangle(float a, float b, float c)
        {            
            s1 = a;
            s2 = b;
            s3 = c;
            if (!Valid)
            {
                // https://docs.microsoft.com/it-it/dotnet/api/system.exception?view=netframework-4.7.1
                throw new ArgumentException("Invalid data for a triangle.");
            }
        }
        
        public bool Valid
        {
            get
            {
                return s1+s2>s3 && s1+s3>s2 && s2+s3>s1;
            }
        }

        public float Perimeter
        {
            get
            {
                return s1+s2+s3;
            }
        }
        
    }


    class Program
    {
        static void Main(string[] args)
        {
            Triangle t;
            
            try
            {
                t = new Triangle(5,2,20);   // this will fail
                Console.WriteLine("ok");    // this will not be executed
                Console.WriteLine(t.Valid);
            }
            catch (Exception e)
            {
                Console.WriteLine("Could not create the triangle");
                Console.WriteLine(e.Message);
            }
            
            try
            {
                t = new Triangle(5,4,3);
                Console.WriteLine("ok");    // this will be ok
                Console.WriteLine(t.Valid); // this will be executed
            }
            catch (Exception e)
            {
                Console.WriteLine("Could not create the triangle");
                Console.WriteLine(e.Message);
            }
        }
    }
}
