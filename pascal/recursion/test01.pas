program ricorsione(input, output);

var
	count: longint;

procedure alfa(livello: integer);
begin
	writeln('contatore: ', count);
	writeln('entro e sono al livello ', livello);
	inc(count);
	if count < 5 then
		alfa(livello+1);
	writeln('esco dal livello ', livello);
end;

BEGIN
	count:=0;
	alfa(0);
END.
