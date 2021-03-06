Program ScanDir01;

Uses SysUtils;


Procedure ScanDir(path: string);

Var Info : TSearchRec;
    Count : Longint;

Begin
  Count:=0;
  writeln('Scanning directory ' + path + '...');
  If FindFirst (path + '/*', faDirectory, Info)=0 then
    begin
    Repeat
      Inc(Count);
      With Info do
        begin
        if (name<>'.') and (name<>'..') then
			begin
				Write (Name:40,Size:15);
				if (Attr and faDirectory) = faDirectory then
					begin
						Writeln(' (directory)');
						ScanDir(path + '/' + name);
					end
				else
					Write(' (ordinary file)');
				Writeln;
			end;
        end;
    Until FindNext(info)<>0;
    end;
  FindClose(Info);
End;

Begin
ScanDir('abc');
End.
