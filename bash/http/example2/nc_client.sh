#!/bin/bash

# To show what "Connection: keep-alive" mean
#
# Say that the web server has two resources available, namely 
# "texts/first.txt" and "texts/second.txt" and that the client
# wants to receive both of them.
# If the request has the "Connection: keep-alive" line (default in
# HTTP/1.1), the server will serve requested files, one after the other.

# Change "Connection: keep-alive" to "Connection: close" to see the
# difference.

PORT=80
HOST=127.0.0.1

(cat <<EOF
GET /texts/first.txt HTTP/1.1
Host: $HOST:$PORT
Connection: keep-alive
User-Agent: netcat user agent

GET /texts/second.txt HTTP/1.1
Host: $HOST:$PORT
Connection: keep-alive
User-Agent: netcat user agent

EOF
) | nc $HOST $PORT
