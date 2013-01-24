#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv)
{
  printf("Examples with struct\n");
  
  typedef struct p {
	  int x;
	  int y;
	  
	  // this is not strict C anymore...
	  // doesn't compile with gcc, only with g++
	  
	  int addx(int v){
		  x+=v;
	  }
	  int addy(int v){
		  y+=v;
	  }
  } point;
  
  
  point p1;
  
  p1.x=5;
  p1.y=7;
  
  printf("Point (%d;%d)\n", p1.x, p1.y);

  p1.addx(2);
  p1.addy(4);
  
  printf("Point (%d;%d)\n", p1.x, p1.y);
  
  return 0;
}
