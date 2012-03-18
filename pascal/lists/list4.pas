program list4;

{
  partendo da list4.pas, aggiungiamo:
  - la visualizzazione della lista
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

  l := nil;  { inizializza una lista vuota }

  new(p); { creo un primo elemento di tipo TPerson; p punta all'elemento creato }

  initPerson(p, 'Alice', 'Alessandrini', 21);

  l:=p;  { la mia lista adesso punta inizia con p }

  new(p); { creo un secondo elemento di tipo TPerson; p punta all'elemento creato }

  initPerson(p, 'Bruno', 'Bertoli', 22);
  p^.next := l;  { il nuovo elemento punta a quello a cui puntava prima l }

  l:=p;  { l adesso inizia con il nuovo elemento }

  showList(l);
  


end.