program tree03(Input,Output);

{
  * aggiungiamo una procedura ricorsiva per la visualizzazione
  * }

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
   
   procedure process(t: TTree);
   begin
    writeln(t^.name);
   end;
   
   procedure showTree(var t: TTree);
   begin
      if t<>nil then
        begin
          process(t);
          showTree(t^.firstchild);
          showTree(t^.sibling);
        end;
   
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
