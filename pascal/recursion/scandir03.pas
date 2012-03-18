Program ScanDir03;

Uses SysUtils;

Procedure Space(level: integer);
var i: integer;
begin
	for i:=1 to level*2 do
		write(' ');
end;


Procedure _ScanDir(path: string; level: integer);

Var Info : TSearchRec;
    Count : Longint;

Begin
  Count:=0;
  {writeln('Scanning directory ' + path + ' (level: ', level, ') ...');}
  If FindFirst (path + '/*', faDirectory, Info)=0 then
    begin
    Repeat
      Inc(Count);
      With Info do
        begin
        if (name<>'.') and (name<>'..') then
			begin
				Space(level);
				Write (Name);
				if (Attr and faDirectory) = faDirectory then
					begin
						Writeln(' (directory)');
						_ScanDir(path + '/' + name, level+1);
					end
				else
					Writeln(' (ordinary file)');
			end;
        end;
    Until FindNext(info)<>0;
    end;
  FindClose(Info);
End;

Procedure ScanDir(path: string);
begin
	_ScanDir(path, 0);
end;

Begin
ScanDir('abc');
End.
