program list2;

{
  partendo da list1.pas, facciamo delle migliorie:
  - una procedura per l'input dei dati di un elemento 
  - una procedura per l'output dei dati di un elemento
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

  p: TPtr;

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

begin

  new(p); { creo un elemento di tipo TPerson; p punta all'elemento creato }

  readPerson(p);
  showPerson(p);

  dispose(p);  { elimino l'elemento puntato da p }


end.