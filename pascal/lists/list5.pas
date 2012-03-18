program list5;

{
  partendo da list4.pas, facciamo un piccolo esperimento 
  per valutare l'impatto sulla memoria
}

type

  TPtr = ^TPerson;
  
  TPerson = record
    name: string;
    surname: string;
    age: integer;
    extra: array[1..100000000] of integer;
    next: TPtr;
  end;

var

  l: TPtr;  { questo è il puntatore alla lista }
  p: TPtr;
  count: longint;

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

  count:=0;
  while true do
  begin
    new(p);
    inc(count);
    writeln('aggiunto elemento ', count);
  end;

end.
