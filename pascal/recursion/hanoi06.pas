program hanoi05 (input, output);

type
	towers = record
		disks: array[1..3] of integer;
		max: integer;
	end;

var
	t: towers;
  
  number: integer;
  err: integer;

function items(n, max: integer): string;
var 
	s: string;
	i: integer;
begin
	s:='';
	for i:=1 to max do
		if i<=n then
			s:=s+'O'
		else
			s:=s+'-';
	items:=s;
end;


procedure show(t: towers);
var i:integer;
begin
	for i:=1 to 3 do
		writeln(i, '> ',  items(t.disks[i], t.max));
	writeln;
	writeln;
end;


procedure MoveDisk(source, target: integer; var t:towers);
begin
	writeln('MOVE:   ', source, ' --> ', target);
	dec(t.disks[source]);
	inc(t.disks[target]);
	show(t);
end;

procedure MoveDisks(howMany: integer; source, target: integer; var t:towers);
var
	help: integer;

begin
	{writeln('I must move ', howMany, ' disk(s) from tower ', source, ' to tower ', target);}
	help:= 6 -source -target;
	if howMany>1 then
		begin
			{writeln('I will use tower ', help, ' as help');}
			MoveDisks(howMany-1, source, help, t);
			MoveDisks(1, source, target, t);
			MoveDisks(howMany-1, help, target, t);
		end
	else
		begin
			{writeln('I can manage without help...');}
			MoveDisk(source, target, t);
		end;
end;

procedure Hanoi(disks: integer; var t:towers);
begin
	t.disks[1]:=disks;
	t.disks[2]:=0;
	t.disks[3]:=0;
	t.max:=disks;
	
	show(t);
	
	MoveDisks(disks, 1, 3, t);
	{ move *disks* disks from tower 1 to tower 3 }

end;

begin
  val(ParamStr(1), number, err);
  if err>0 then number:=3;
  
  
	Hanoi(number, t);
end.

