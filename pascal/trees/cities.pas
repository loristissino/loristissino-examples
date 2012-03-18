program cities(Input,Output);
  
   TYPE
      TList=^TNode;
      TNode=record
      	name:string[10];
        next:TList;
      end;

   var
      current: TList;


procedure makelink(var source: TList; target: TList);
{ fa un link tra source e target }
begin
  source^.next:=target;
  writeln('DEBUG ', source^.name, ' -> ', target^.name);
end;

procedure file2list(filename: string; var current: TList);
{ carica le città da un file di testo (una città per riga);
* aggancia l'ultima città alla prima }

var
   citiesfile: text;
   isfirst: boolean;
   currentcity: string;
   first, previous: TList;

begin
   assign(citiesfile, 'cities.txt');
   reset(citiesfile);
      
   previous:=nil;
      
   isfirst:=true;
   while not eof(citiesfile) do
      begin
        readln(citiesfile, currentcity);
        new(current);
        current^.name:=currentcity;
        writeln('DEBUG +', currentcity);
        if isfirst then
          begin
            first:=current;
            isfirst:=false;
            current^.next:=nil;
          end
        else
          begin
            makelink(previous, current);
          end;
        previous:=current;
      end;
    makelink(current, first); {aggancio l'ultima città alla prima}
    current:=first;
end;

procedure showlist(first: TList);
{ mostra tutta la lista circolare, fermandosi quando trova 
* una città con lo stesso nome da cui è partita la visualizzazione }

begin
    writeln('=== Elenco città ===');
    current:=first;
    { ci teniamo un puntatore al primo elemento in modo da 
    * poter fare il confronto }
    repeat
        writeln(current^.name);
        current:=current^.next;
    until first^.name=current^.name;
    

end;

   begin {main}
   
      file2list('cities.txt', current);
      
      showlist(current);

   end.
