program tree06(Input,Output);

{
  * implementiamo una procedura di eliminazione
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
      t:TTree;
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
          writeln('#debug: elimino: ', t^.name);
          dispose(t);
          t:=nil;
        end;
   
   end;

  procedure DeleteTree(var t: TTree);
  begin
    writeln('== Eliminazione ricorsiva albero ==');
    _deleteTree(t);
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
    deleteTree(t);
    showTreePFS(t);
   
   end.
