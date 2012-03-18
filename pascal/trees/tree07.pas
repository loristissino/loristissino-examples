program tree07(Input,Output);

{
  * implementiamo una funzione di ricerca (che restituisce il primo
  * elemento incontrato che soddisfa il criterio)
  * 
  * }
  
   CONST SPACECHAR=' ';

   TYPE
      TTree=^TNode;
      TNode=record
      	name:string[10];
        firstchild:TTree;
        sibling:TTree;
      end;
   var
      t,f: TTree;
   procedure initTree(var t:TTree);
      begin
      	t:=NIL;
      end;
      
   function newItem(name: string): TTree;
   var item: TTree;
   begin
      new(item);
      item^.name:=name;
      item^.firstchild:=nil;
      item^.sibling:=nil;
      newItem:=item;
   end;
   
   procedure space(number: integer);
   var i: integer;
   begin
    for i:=1 to number do
      write(SPACECHAR);
   end;
   
   procedure process(t: TTree; level: integer);
   begin
    space(level);
    writeln(t^.name);
   end;
   
   procedure _showTreePFS(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          process(t, level);
          _showTreePFS(t^.firstchild, level+1);
          _showTreePFS(t^.sibling, level);
        end;
   
   end;

  procedure ShowTreePFS(var t: TTree);
  begin
    writeln('== Visualizzazione albero PFS ==');
    _showTreePFS(t, 0);
  end;

   procedure _deleteTree(var t: TTree);
   begin
      if t<>nil then
        begin
          _deleteTree(t^.firstchild);
          _deleteTree(t^.sibling);
          {writeln('#debug: elimino: ', t^.name);}
          dispose(t);
          t:=nil;
        end;
   
   end;

  procedure DeleteTree(var t: TTree);
  begin
    writeln('== Eliminazione ricorsiva albero ==');
    _deleteTree(t);
  end;
  
  procedure _searchItem(var t: Ttree; name: string; var found: TTree);
   begin
      if t<>nil then
        begin
          writeln('#debug: checking...', t^.name);
          if t^.name=name then
            begin
              found:=t;
            end;
          if found=nil then
            begin
              _searchItem(t^.firstchild, name, found);
              _searchItem(t^.sibling, name, found);
            end;
        end;
   end;
  
  function findItem(var t: Ttree; name: string): TTree;
  var found: TTree;
  begin
    writeln('== Ricerca elemento name="', name, '"');
    found:=nil;
    _searchItem(t, name, found);
    findItem:=found;
  end;


   begin {main}
    initTree(t);
    t:=newItem('HTML');
    
    t^.firstchild:=newItem('HEAD');
    t^.firstchild^.sibling:=newItem('BODY');
    t^.firstchild^.firstchild:=newItem('TITLE');
    t^.firstchild^.firstchild^.sibling:=newItem('META');
    t^.firstchild^.firstchild^.sibling^.sibling:=newItem('LINK');    
    t^.firstchild^.sibling^.firstchild:=newItem('H1');
    t^.firstchild^.sibling^.firstchild^.sibling:=newItem('P');
    
    showTreePFS(t);
    
    f:=findItem(t, 'HTML');
    writeln('Found: ', f^.name);
    
    f:=findItem(t, 'META');
    writeln('Found: ', f^.name);
    
    deleteTree(t);
   
   end.
