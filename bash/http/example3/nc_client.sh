#!/bin/bash

# This example assumes that there is a service available at
# /texts/receiver.php dealing with a POST request
# A simple
#
# <?php
#    header("Content-type: text/plain");
#    print_r($_POST);
#
# php script will do.

PORT=80
HOST=127.0.0.1
VALUES="first=John&last=Smith"
LENGTH=$(LANG=C echo ${#VALUES})

(cat <<EOF
POST /texts/receiver.php HTTP/1.1
Host: $HOST:$PORT
Content-Length: $LENGTH
Content-Type: application/x-www-form-urlencoded
User-Agent: netcat user agent

$VALUES

EOF
) | nc $HOST $PORT
