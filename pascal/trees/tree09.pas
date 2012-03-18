program tree09(Input,Output);

{
  * implementiamo una procedura che ci consenta di inserire un 
  * nuovo nodo come figlio di un nodo esistente di cui è noto l'id
  * }
  
   CONST SPACECHAR=' ';

   TYPE
      TTree=^TNode;
      TNode=record
        id: longint;
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
      
   function newItem(id: longint; name: string): TTree;
   var item: TTree;
   begin
      new(item);
      item^.id:=id;
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
    writeln(t^.name, ' (id ', t^.id, ')');
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
  
  procedure _searchItemByName(var t: Ttree; name: string; var found: TTree);
   begin
      if t<>nil then
        begin
          {writeln('#debug: checking...', t^.name);}
          if t^.name=name then
            begin
              found:=t;
            end;
          if found=nil then
            begin
              _searchItemByName(t^.firstchild, name, found);
              _searchItemByName(t^.sibling, name, found);
            end;
        end;
   end;
  
  function findItemByName(var t: Ttree; name: string): TTree;
  var found: TTree;
  begin
    writeln('== Ricerca elemento name="', name, '"');
    found:=nil;
    _searchItemByName(t, name, found);
    findItemByName:=found;
  end;

  procedure _searchItemById(var t: Ttree; id: longint; var found: TTree);
   begin
      if t<>nil then
        begin
          {writeln('#debug: checking...', t^.name);}
          if t^.id=id then
            begin
              found:=t;
            end;
          if found=nil then
            begin
              _searchItemById(t^.firstchild, id, found);
              _searchItemById(t^.sibling, id, found);
            end;
        end;
   end;
  
  function findItemById(var t: Ttree; id: longint): TTree;
  var found: TTree;
  begin
    writeln('== Ricerca elemento id=', id);
    found:=nil;
    _searchItemById(t, id, found);
    findItemById:=found;
  end;


  procedure insertItem(var t: TTree; parent_id, child_id: integer; name: string);
  var f:TTree;
  begin
    writeln('== Inserimento di elemento id=', child_id, ', figlio di id=', parent_id, ' (name="', name, '") ==');
    f:=findItemById(t, parent_id);
    if f<>nil then
      begin
        if f^.firstchild=nil then
          begin
            f^.firstchild:=newItem(child_id, name);
          end
        else
          begin
            f:=f^.firstchild;
            while f^.sibling<>nil do
              begin
                f:=f^.sibling;
              end;
            f^.sibling:=newItem(child_id, name);
          end;
      end
  end;

   begin {main}
    initTree(t);
    t:=newItem(1, 'HTML');
    
    t^.firstchild:=newItem(2, 'HEAD');
    t^.firstchild^.sibling:=newItem(3, 'BODY');
    t^.firstchild^.firstchild:=newItem(4, 'TITLE');
    t^.firstchild^.firstchild^.sibling:=newItem(5, 'META');
    t^.firstchild^.firstchild^.sibling^.sibling:=newItem(6, 'LINK');    
    t^.firstchild^.sibling^.firstchild:=newItem(7, 'H1');
    t^.firstchild^.sibling^.firstchild^.sibling:=newItem(8, 'P');
    
    showTreePFS(t);
    
    f:=findItemById(t, 1);
    writeln('Found: ', f^.name);
    
    f:=findItemById(t, 5);
    writeln('Found: ', f^.name);
    
    f:=findItemById(t, 3);
    writeln('Found: ', f^.name);
    
    insertItem(t, 3, 9, 'H2');
    insertItem(t, 8, 10, 'EM');
    
    showTreePFS(t);
    
    deleteTree(t);
   
   end.
