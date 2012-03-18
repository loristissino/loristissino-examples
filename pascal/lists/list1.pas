program list1;

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

begin

  new(p); { creo un elemento di tipo TPerson; p punta all'elemento creato }

  p^.name := 'John';
  p^.surname := 'Smith';
  p^.age := 22;
  p^.next := nil;

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


  dispose(p);  { elimino l'elemento puntato da p }
  

end.