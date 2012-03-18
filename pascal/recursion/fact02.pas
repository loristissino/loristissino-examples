program fact02;

function fact(n: integer): longint;
var
	f: longint;
begin
	writeln('called with n=', n);
	if n=0 then
		begin
			f:=1;
			writeln('deepest level reached!!');
		end	
	else
		f:=n*fact(n-1);
	writeln('computed f=', f);
	fact:=f;
end;

begin
	writeln(fact(5));
end.
