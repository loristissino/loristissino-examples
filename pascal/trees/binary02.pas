program binary02(Input,Output);

{
  * aggiungiamo la visualizzazione dell'albero, che ci mostra i dati
  * inseriti ordinati per valore
  * }
  
   CONST
    SPACECHAR=' ';
    DIM = 20;

   TYPE
      TTree=^TNode;
      TNode=record
        value: longint;
        left:TTree;
        right:TTree;
      end;
      TSampleArray=Array[1..DIM] of longint;

   var
      t: TTree;
      v: TSampleArray;
      
   procedure initTree(var t:TTree);
      begin
      	t:=NIL;
      end;
       
   procedure initSampleArray(var v: TSampleArray);
   var i: integer;
   begin
    for i:=1 to DIM do
        v[i]:=random(9000)+1000;
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
    writeln(t^.value);
   end;
   
   
  procedure _insertItem(var t: TTree; n: TTree);
  begin
    if t=nil then
      begin
        t:=n;
        writeln('!');
      end
    else
      begin
        if n^.value > t^.value then
          begin
            write('R');
            _insertItem(t^.right, n);
          end
        else
          begin
            write('L');
            _insertItem(t^.left, n);
          end;
      end;
  end;
 
  procedure insertItem(var t: TTree; v: longint);
  var
    n: TTree;
  begin
    writeln('#debug: inserisco ', v, '...');
    new(n);
    n^.value:=v;
    n^.left:=nil;
    n^.right:=nil;
    _insertItem(t, n);
    
  end;
  
  procedure _showTree(var t: TTree; level: integer);
  begin
    if t<>nil then
      begin
        _showTree(t^.left, level+1);
        process(t, level);
        _showTree(t^.right, level+1);
      end;
  end;
  
  procedure showTree(var t: TTree);
  begin
    Writeln('== Visualizzazione albero ==');
    _showTree(t, 0);
  end;
   
  procedure loadSampleArray(var v: TSampleArray; var t: TTree);
  var i: integer;
  begin
    for i:=1 to DIM do
      begin
        insertItem(t, v[i]);
      end;
  end;


   begin {main}
    {randomize;}
    initTree(t);
    initSampleArray(v);
    
    loadSampleArray(v, t);
    
    showTree(t);
   
   end.
