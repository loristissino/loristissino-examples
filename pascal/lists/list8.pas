program list8;

{
  partendo da list7.pas, aggiungiamo il codice
  per eliminare gli elementi della lista.
}

uses
  sysutils;

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


{
function IntToString(n: Longint): string;
var
  s: string;
begin
  s:='';
  str(s, n);
  IntToString:=s;
end;
}

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

procedure _showListFromEnd(l: TPtr);
begin
  if l<>nil then
    begin
      _showListFromEnd(l^.next);
       showPerson(l);
    end;
end;

procedure showListFromEnd(l: TPtr);
begin
  writeln('==== LISTA INVERTITA ====');
  _showListFromEnd(l);
end;

procedure _deleteList(l: TPtr);
begin
  if l<>nil then
    begin
      _deleteList(l^.next);
      Writeln('Debug: elimino un elemento');
      dispose(l);
    end;
end;


procedure deleteList(l: TPtr);
begin
  writeln('==== ELIMINAZIONE ELEMENTI DELLA LISTA ====');
  _deleteList(l);
end;

begin

  l:=nil;
  count:=0;
  jobdone:=false;

{
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
}

  for count:=1 to 4 do
   begin
     new(p);
     initPerson(p, 'Nome'+IntToStr(count), 'Cognome'+IntToStr(count), 10+count);
     p^.next:=l;
     l:=p;
   end;

  writeln('Sono stati inseriti ', count, ' elementi.');

{  showList(l); }

{  showListFromEnd(l); }

   deleteList(l);

end.
