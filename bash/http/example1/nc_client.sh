#!/bin/bash

PORT=11080
HOST=127.0.0.1

(cat <<EOF
GET / HTTP/1.1
Host: $HOST:$PORT
Connection: keep-alive
User-Agent: netcat user agent

EOF
) | nc $HOST $PORT
