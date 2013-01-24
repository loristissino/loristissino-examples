#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv)
{
  printf("Examples with struct\n");
  
  typedef struct p {
	  int x;
	  int y;
  } point;
  
  
  point p1, * p2, * p3;
  
  p2 = (point *)malloc(sizeof(point));
  
  p1.x=5;
  p1.y=7;
  
  *p2 = p1;  // here we copy the values
  
  p3 = &p1;  // here we just set the pointer to the other variable
  
  printf("Point %s (%d;%d)\n", "p1", p1.x, p1.y);
  
  printf("Point %s (%d;%d)\n", "*p2", (*p2).x, (*p2).y);
  printf("Point %s (%d;%d)\n", "*p2", p2->x, p2->y); // equivalent to the above one
  
  printf("Point %s (%d;%d)\n", "*p3", p3->x, p3->y);
  
  
  // let's change the values of p1...
  p1.x=10;
  p1.y=11;

  printf("After change...\n");
  printf("Point %s (%d;%d)\n", "p1", p1.x, p1.y);
  printf("Point %s (%d;%d)\n", "*p2", p2->x, p2->y);
  printf("Point %s (%d;%d)\n", "*p3", p3->x, p3->y);

  
  return 0;
}
