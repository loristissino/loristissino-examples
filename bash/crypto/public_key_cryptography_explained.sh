#!/bin/bash

if [[ $# -ne 3 ]]; then
   echo "Arguments: Alice's private key, Bob's private key, common base"
   exit 1
fi

function prime()
{
  KEY=$1
  NAME=$2
  factor $KEY | grep ": $KEY" > /dev/null || ( echo "$KEY is not a prime number";  factor $KEY; exit 1 )
}

ALICE=$1
BOB=$2
Y=$3

prime $ALICE "Alice" || exit 2
prime $BOB "Bob" || exit 2
prime $Y "Base" || exit 2

cat <<EOF


ASYMMETRIC CRYPTOGRAPHY: A TALE

This is a demonstration of how asymmetric cryptography works.

Two people, Alice and Bob, want to send messages each other without
sharing a common secret.

So, they both choose a private key and generate a public key from that,
sharing only the latter. How can this work?

Imagine that Alice and Bob choose a common prime number, that they both
know. Here, suppose they chose Y=$Y.

Alice chooses her own private key as $ALICE.

EOF

MATH="($Y ^ $ALICE)"
PA=$(echo $MATH | bc)
cat <<EOF
She computes her public key as $MATH = $PA, 
and then sends it to Bob.

EOF

MATH="$Y ^ $BOB"
PB=$(echo $MATH | bc)
cat <<EOF
On the other side, Bob computes his public key 
as $MATH = $PB, and sends it to Alice.

EOF

cat <<EOF
Now, Alice has her own private key ($ALICE) and Bob's public key ($PB).
Since she wants to send her message, she first computes a session key
using her own private key and Bob's public key, like here:

EOF

MATH="$PB ^ $ALICE"
SKA=$(echo $MATH | bc)

cat <<EOF
The session key is computed as $MATH.
Its value is 
$SKA

With this session key, Alice can encrypt a message with a symmetric key
program.

When Bob receives the file, he computes the session key using his own
private key and Alice's public key, much like Alice did herself.

EOF

MATH="$PA ^ $BOB"
SKB=$(echo $MATH | bc)
cat <<EOF
The session key is computed as $MATH,
which is exactly the same Alice has used:
$SKB

Why are the two session keys equal?

Because on one side you have

($Y ^ $BOB) ^ $ALICE
(which is Bob's public key to the power of Alice's private key)

and on the other side you have
($Y ^ $ALICE) ^ $BOB
(which is Alice's public key to the power of Bob's private key)

And, of course $Y ^ $BOB ^ $ALICE = $Y ^ $ALICE ^ $BOB.

EOF

