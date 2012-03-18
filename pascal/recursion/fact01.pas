program fact01;

function fact(n: integer): longint;
var 
	i: integer;
	f: longint;
begin
	f:=1;
	for i:=2 to n do
		f:=f*i;
	fact:=f
end;

begin
	writeln(fact(5));
end.
