program list6;

{
  partendo da list5.pas, modifichiamo il codice in modo 
  da gestire in maniera interattiva la lista
}

type

  TPtr = ^TPerson;
  
  TPerson = record
    name: string;
    surname: string;
    age: integer;
    next: TPtr;
  end;

var

  l: TPtr;  { questo è il puntatore alla lista }
  p: TPtr;
  count: longint;
  jobdone: boolean;
  answer: string;

procedure initPerson(p: TPtr; name, surname: string; age: integer);
begin
  p^.name := name;
  p^.surname := surname;
  p^.age := age;
end;

procedure readPerson(p: TPtr);
begin
  Writeln('Inserisci il nome:');
  Readln(p^.name);
  Writeln('Inserisci il cognome:');
  Readln(p^.surname);
  Writeln('Inserisci l''età:');
  Readln(p^.age);
end;

procedure showPerson(p: TPtr);
begin
  writeln('Nome:    ', p^.name);
  writeln('Cognome: ', p^.surname);
  writeln('Età:     ', p^.age);

  if (p^.next = nil) then
    begin
      writeln('Ultimo della lista.');
    end
  else
    begin
      writeln('C''è qualcuno dopo...');
    end;
  writeln('-------------------------------');
end;

procedure showList(l: TPtr);
begin
  writeln('==== LISTA COMPLETA ====');
  while (l<>nil) do
    begin
      showPerson(l);
      l := l^.next;
    end;

end;

begin

  l:=nil;
  count:=0;
  jobdone:=false;

  while not jobdone do
  begin
    new(p);
    readPerson(p);
    p^.next:=l;
    l:=p;
    inc(count);
    writeln('Vuoi inserire un altro elemento?');
    readln(answer);
    if upcase(answer[1])<>'S' then
	begin
		jobdone:=true;
	end
  end;

  writeln('Sono stati inseriti ', count, ' elementi.');

  showList(l);

end.
