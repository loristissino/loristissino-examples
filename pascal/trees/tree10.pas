program tree10(Input,Output);

{
  * sfruttando la procedura di inserimento definita, facciamo in modo
  * che il caricamento iniziale dei dati avvenga a partire da un
  * array predefinito, in cui sono indicati i legami padre/figlio
  * }
  
   CONST
    SPACECHAR=' ';
    DIM = 8;

   TYPE
      TTree=^TNode;
      TNode=record
        id: longint;
      	name:string[10];
        firstchild:TTree;
        sibling:TTree;
      end;
      TValue=record
        parent_id:longint;
        id: longint;
        name:string[20];
      end;
      TSampleArray=Array[1..DIM] of TValue;

   var
      t,f: TTree;
      v: TSampleArray;
      
   procedure initTree(var t:TTree);
      begin
      	t:=NIL;
      end;
    
   procedure initSampleRecord(var r: TValue; parent_id, id: longint; name: string);
   begin
      r.parent_id:= parent_id;
      r.id:= id;
      r.name:= name;
   end;
   
   procedure initSampleArray(var v: TSampleArray);
   begin
    initSampleRecord(v[1], 0, 1, 'HTML');
    initSampleRecord(v[2], 1, 2, 'HEAD');
    initSampleRecord(v[3], 1, 3, 'BODY');
    initSampleRecord(v[4], 2, 4, 'TITLE');
    initSampleRecord(v[5], 2, 5, 'META');
    initSampleRecord(v[6], 2, 6, 'LINK');
    initSampleRecord(v[7], 3, 7, 'H1');
    initSampleRecord(v[8], 3, 8, 'P');
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

  procedure loadSampleArray(var v: TSampleArray; var t: TTree);
  var i: integer;
  begin
    for i:=1 to DIM do
      begin
        if v[i].parent_id=0 then
          begin
            t:=newItem(v[i].id, v[i].name)
          end
        else
          begin
            insertItem(t, v[i].parent_id, v[i].id, v[i].name);
          end;
      end;
  end;


   begin {main}
    initTree(t);
    initSampleArray(v);
    
    loadSampleArray(v, t);
    
    showTreePFS(t);
        
    insertItem(t, 3, 9, 'H2');
    insertItem(t, 8, 10, 'EM');
    
    showTreePFS(t);
    
    deleteTree(t);
   
   end.
