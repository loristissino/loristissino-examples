#include <stdio.h>

int main(int argc, char **argv)
{
  printf("Examples with struct\n");
  
  typedef struct p {
	  int x;
	  int y;
  } point;
  
  
  point p1, p2;
  
  p1.x=5;
  p1.y=7;
  
  p2.x=-1;
  p2.y=3;
  
  printf("Point (%d;%d)\n", p1.x, p1.y);
  printf("Point (%d;%d)\n", p2.x, p2.y);
  
  return 0;
}
