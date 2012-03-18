program hanoi04 (input, output);

procedure MoveDisk(source, target: integer);
begin
	writeln(source, ' --> ', target);
end;

procedure MoveDisks(howMany: integer; source, target: integer);
var
	help: integer;

begin
	{writeln('I must move ', howMany, ' disk(s) from tower ', source, ' to tower ', target);}
	help:= 6 -source -target;
	if howMany>1 then
		begin
{			writeln('I will use tower ', help, ' as help');}
			MoveDisks(howMany-1, source, help);
			MoveDisks(1, source, target);
			MoveDisks(howMany-1, help, target);
		end
	else
		begin
{			writeln('I can manage without help...');}
			MoveDisk(source, target);
		end;
end;

begin
	MoveDisks(5, 1, 3);
	{ move 20 disks from tower 1 to tower 3 }
end.

