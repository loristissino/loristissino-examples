program tree01(Input,Output);

{
  * implementiamo una prima struttura di memoria in grado di 
  * rappresentare l'albero degli elementi di una pagina web
  * 
  * HTML
  *   HEAD
  *     TITLE
  *     META
  *     LINK
  *   BODY
  *     H1
  *     P
  *
  * }

   TYPE
      TTree=^TNode;
      TNode=record
      	name:string[10];
        firstchild:TTree;
        sibling:TTree;
      end;
   var
      t, item:TTree;
   procedure initTree(var t:TTree);
      begin
      	t:=NIL;
      end;

   begin {main}
    initTree(t);
    new(item);
    item^.name:='HTML';
    item^.firstchild:=NIL;
    item^.sibling:=NIL;
    
    t:=item;
    
    writeln(t^.name); {visualizza HTML}
    
    new(item);
    item^.name:='HEAD';
    item^.firstchild:=NIL;
    item^.sibling:=NIL;
    
    t^.firstchild:=item;
    
    writeln(t^.firstchild^.name); {visualizza HEAD}
    
    new(item);
    item^.name:='BODY';
    item^.firstchild:=NIL;
    item^.sibling:=NIL;
    
    t^.firstchild^.sibling:=item;
    writeln(t^.firstchild^.sibling^.name); {visualizza BODY}
    
    new(item);
    item^.name:='TITLE';
    item^.firstchild:=NIL;
    item^.sibling:=NIL;
   
    t^.firstchild^.firstchild:=item;
    writeln(t^.firstchild^.firstchild^.name); {visualizza TITLE}
   
   end.
