program tree02(Input,Output);

{
  * definiamo una più conveniente procedura di inizializzazione
  * 
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

   begin {main}
    initTree(t);
    t:=newItem('HTML');
    writeln(t^.name); {visualizza BODY}
    
    t^.firstchild:=newItem('HEAD');
    writeln(t^.firstchild^.name); {visualizza HEAD}
    
    t^.firstchild^.sibling:=newItem('BODY');
    writeln(t^.firstchild^.sibling^.name); {visualizza BODY}
    
    t^.firstchild^.firstchild:=newItem('TITLE');
    writeln(t^.firstchild^.firstchild^.name); {visualizza TITLE}
    
    t^.firstchild^.firstchild^.sibling:=newItem('META');
    t^.firstchild^.firstchild^.sibling^.sibling:=newItem('LINK');    
    t^.firstchild^.sibling^.firstchild:=newItem('H1');
    t^.firstchild^.sibling^.firstchild^.sibling:=newItem('P');
    
   
   end.
