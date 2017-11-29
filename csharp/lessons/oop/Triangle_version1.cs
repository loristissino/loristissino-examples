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
            t = new Triangle(5,2,20);
            Console.WriteLine(t.Valid);  // False
            if (t.Valid)
            {
                Console.WriteLine(t.Perimeter);
            }
            
            t = new Triangle(5,4,3);
            if (t.Valid)
            {
                Console.WriteLine(t.Perimeter);
            }
            Console.WriteLine(t.Valid);  // True
        }
    }
}
