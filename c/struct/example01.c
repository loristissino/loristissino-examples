#include <stdio.h>

int main(int argc, char **argv)
{
  printf("Examples with struct\n");
  
  struct point {
	  int x;
	  int y;
  } p;
  
  p.x=5;
  p.y=7;
  
  printf("Point (%d;%d)\n", p.x, p.y);
  
  return 0;
}
