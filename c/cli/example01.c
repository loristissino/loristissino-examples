#include <stdio.h>

int main(int argc, char **argv)
{
  printf("Examples with command line arguments\n");

  printf("There are %d argument(s) on the command line\n", argc);
  printf("(the first is the program name, as you might have noticed)\n", argc);
  
  printf("Here's the list with a traditional loop:\n");
  int i;
  for(i=0; i < argc; i++)
  {
    printf("%d) %s\n", i, argv[i]);
  }
  
  
  printf("Here's an alternative loop, without the counter\n");
  printf("(we just decrement the value of argc until it reaches 0):\n");
  for (argc--, argv++; argc > 0; argc--, argv++)
  {
    printf("%d) %s\n", argc, *argv);
  }
  
  return 0;
}
