#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv)
{
  printf("Examples with command line arguments\n");

  printf("This program will read a text file specified on the command line.\n");

  if(argc != 2)
  {
    fprintf(stderr, "Missing file name\n");
    return 1;
  }
  
  FILE *fp = fopen(argv[1], "r");
  
  if(fp==NULL)
  {
    fprintf(stderr, "Sorry, could not open file «%s»\n", argv[1]);
    return 2;
  }

  int v; // fgetc returns an int, not a char
  while ((v = fgetc(fp)) != EOF)
  {
    printf("%c", v);
  }
  
  return 0;
}
