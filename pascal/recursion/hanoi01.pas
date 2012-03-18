program hanoi01 (input, output);

procedure MoveDisks(howMany: integer; source, target: integer);
begin
	writeln('I must move ', howMany, ' disks from tower ', source, ' to tower ', target);
end;

begin
	MoveDisks(5, 1, 3);
	{ move 5 disks from tower 1 to tower 3 }
end.

