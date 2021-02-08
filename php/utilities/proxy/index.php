<?php

$custom_header = 'X-Proxy: YourProxyServerName'; // customize this

$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['QUERY_STRING'];

$options = array(
  'http'=>array(
    'method'=>$method,
  )
);

$body = file_get_contents('php://input');

if ($body) {
    $options['http']['content'] = $body;
}

// TODO: take care of other headers, like authentication ones

$context = stream_context_create($options);

$content = file_get_contents($url, false, $context);

$http_response_header[]=$custom_header;

foreach($http_response_header as $header) {
    header($header);
}

echo $content;
