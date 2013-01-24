#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv)
{
  printf("Examples with command line arguments\n");

  printf("This program will sum up the numbers on the command line.\n", argc);

  float sum = 0;
  float v;
  
  int i;
  for(i=1; i < argc; i++)
  {
    v=atof(argv[i]);
    printf("%d) %f\n", i, v);
    sum += v;
  }
  
  printf("The sum is %f.\n", sum);
  
  return 0;
}
