<?php

$custom_header = 'Via: YourServerName';  // customize this

$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['QUERY_STRING'];

$proxied_headers = [
    'HTTP_X_APIKEY' => 'X-Apikey',
    'HTTP_USER_AGENT' => 'User-Agent',
    'HTTP_ACCEPT' => 'Accept',
    'HTTP_AUTHENTICATION' => 'Authentication',
];

$options = [
    'http'=>[
        'method'=>$method,
    ],
];

$body = file_get_contents('php://input');

if ($body) {
    $options['http']['content'] = $body;
}

$headers = [];
foreach($proxied_headers as $key=>$value) {
    if(array_key_exists($_SERVER, $key)){
        $headers[]=$value . ': ' . $_SERVER[$key];
    }
}

if (sizeof($headers)>0) {
    $options['http']['headers'] = $headers;
}

$context = stream_context_create($options);

$content = file_get_contents($url, false, $context);

$http_response_header[]=$custom_header;

foreach($http_response_header as $header) {
    header($header);
}

// logging information...
file_put_contents(date('Ymd-His'). 'log_info.json', json_encode($_SERVER));

echo $content;
