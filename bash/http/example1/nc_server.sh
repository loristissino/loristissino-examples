DATE=$(LANG=C date -u)
PORT=11080

(cat << EOF
HTTP/1.1 200 OK
Content-Type: text/plain; charset=utf-8
Date: $DATE
Server: netcat_server

Some text sent by the web server.

EOF
) | nc -l $PORT
