program mergesort(input, output);

{
	adapted from
	http://www.ee.ic.ac.uk/t.clarke/arch/OLD/ise1b/PASCAL%20implementation%20of%20mergesort%20program.doc
}
(* PASCAL implementation of mergesort program *)
(* uses recursion *)

const size = 10; (* must be larger than the number of items sorted *)

type TArray = array[ 1 .. size] of integer;

(* use global array of fixed size *)
var items: TArray;

(* return sub-arrays [al..m], and [m+1..bh] merged together
* as a single array [al..bh]
* al <= m <= bh
*
* if a=b need to do nothing
* it is an error if a > b
*)
procedure merge(var items: TArray; al, m, bh : integer);
var temp : TArray;
var dest, apt, bpt, numel : integer;
begin
	writeln(' merging from ', al, ' to ', bh, ' (middle: ', m, ')');
	numel := bh-al+1; (* number of items to merge *)
	apt := al; (* points to bottom of al..m subarray *)
	bpt := m+1; (* points to bottom of m+1..bh subarray *)
	(* create merged array temo from two input subarrays *)
	for dest := 1 to numel do
		begin
			if (apt > m) or (( bpt <= bh) and (items[bpt] < items[apt])) then
				begin (* transfer the b array item *)
					temp[dest] := items[bpt];
					bpt := bpt + 1;
				end
			else
				begin (* transfer the a array item *)
					temp[dest] := items[apt];
					apt := apt + 1;
				end;
		end;
	(* copy result back to input array *)
	for dest := 1 to numel do
		items[al+dest-1] := temp[dest];
end; { merge }


(* return elements a..b of integer array items sorted in ascending order *)
(* if a >= b procedure returns immediately *)
procedure sort(var items: TArray; a, b: integer);
var mid: integer;
begin
	writeln('sorting from ', a, ' to ', b, '...');
	if a < b then
		begin
			mid := (a+b) div 2;
			sort(items, a, mid);
			sort(items, mid+1, b);
			merge(items, a, mid, b);
		end;
end; { sort }

(* show the array *)
procedure show(var items: TArray);
var i: integer;
begin
	for i:=1 to size do
		begin
			writeln(items[i]:6);
		end;
end;

(* initialize the array with random values *)
procedure init(var items: TArray);
var i: integer;
begin
	{ inseriamo valori casuali }
	for i:=1 to size do
		begin
			items[i]:=random(10000);
		end;
end;

begin
	randomize;
	init(items);
	show(items);
	sort(items, 1, size);
	writeln('====');
	show(items);
	
end.
