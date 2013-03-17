#!/bin/bash

# Note:
# This is an obvious demonstration to do, and you wouldn't actually
# need an example with actual numbers for that.
#
# I wrote it just as an example of bash script calling external 
# programs and getting their output...

if [[ $# -ne 3 ]]; then
   echo "Arguments: three integer numbers"
   exit 1
fi

A=$1
B=$2
C=$3

RA=$(echo "$A % $C" | bc)
MA=$(echo "$A / $C" | bc)
RB=$(echo "$B % $C" | bc)
MB=$(echo "$B / $C" | bc)

cat <<EOF

We want to show that 
($A + $B) % $C = (($A % $C) + ($B % $C)) % $C
which is, by computing the expression on the right side:
($A + $B) % $C = ($RA + $RB) % $C

Now, since
$A = $MA * $C + $RA
and
$B = $MB * $C + $RB

we can say that

($A + $B) % $C = ($MA * $C + $RA + $MB * $C + $RB) % $C

and since $MA * $C and $MB * $C are, obviously, multiples of $C, we
can strip them away:

($A + $B) % $C = ($RA + $RB) % $C

... thus obtaining what we wanted to show.

EOF
  
