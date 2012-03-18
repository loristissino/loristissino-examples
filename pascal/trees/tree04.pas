program tree04(Input,Output);

{
  * aggiungiamo una procedura wrapper e una interna con la gestione
  * dei livelli
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
   
   procedure _showTree(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          process(t, level);
          _showTree(t^.firstchild, level+1);
          _showTree(t^.sibling, level);
        end;
   
   end;

  procedure ShowTree(var t: TTree);
  begin
    writeln('== Visualizzazione albero ==');
    _showTree(t, 0);
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
    
    showTree(t);
   
   end.
