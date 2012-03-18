program tree05(Input,Output);

{
  * differenziamo le procedure di visualizzazione
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

   procedure _showTreeFPS(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          _showTreeFPS(t^.firstchild, level+1);
          process(t, level);
          _showTreeFPS(t^.sibling, level);
        end;
   
   end;

  procedure ShowTreeFPS(var t: TTree);
  begin
    writeln('== Visualizzazione albero FPS ==');
    _showTreeFPS(t, 0);
  end;

   procedure _showTreeFSP(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          _showTreeFSP(t^.firstchild, level+1);
          _showTreeFSP(t^.sibling, level);
          process(t, level);
        end;
   
   end;

  procedure ShowTreeFSP(var t: TTree);
  begin
    writeln('== Visualizzazione albero FSP ==');
    _showTreeFSP(t, 0);
  end;

   procedure _showTreePSF(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          process(t, level);
          _showTreePSF(t^.sibling, level);
          _showTreePSF(t^.firstchild, level+1);
        end;
   
   end;

  procedure ShowTreePSF(var t: TTree);
  begin
    writeln('== Visualizzazione albero PSF ==');
    _showTreePSF(t, 0);
  end;

   procedure _showTreeSPF(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          _showTreeSPF(t^.sibling, level);
          process(t, level);
          _showTreeSPF(t^.firstchild, level+1);
        end;
   
   end;

  procedure ShowTreeSPF(var t: TTree);
  begin
    writeln('== Visualizzazione albero SPF ==');
    _showTreeSPF(t, 0);
  end;

   procedure _showTreeSFP(var t: TTree; level: integer);
   begin
      if t<>nil then
        begin
          _showTreeSFP(t^.sibling, level);
          _showTreeSFP(t^.firstchild, level+1);
          process(t, level);
        end;
   
   end;

  procedure ShowTreeSFP(var t: TTree);
  begin
    writeln('== Visualizzazione albero SFP ==');
    _showTreeSFP(t, 0);
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
    showTreeFPS(t);
    showTreeFSP(t);
    showTreePSF(t);
    showTreeSPF(t);
    showTreeSFP(t);
   
   end.
