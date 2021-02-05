<?php

$server = 'https://example.com/updater_SECRETKEY.php';  // replace SECRETKEY with a value you choose

if (sizeof($argv)<2)
{
	die("You must specify the commit id\n");
}

$commit = $argv[1];

$command = 'git diff-tree --name-only --no-commit-id -r ' . $commit;

$output = '';

exec($command, $output);

$request = [];

foreach ($output as $line)
{
	$request[$line]=file_exists($line) ? base64_encode(file_get_contents($line)) : '';
}

/*
if (sizeof($argv)<2)
{
	die("You must specify the file path\n");
}

$file = $argv[1];

$request[$file] = file_exists($file) ? base64_encode(file_get_contents($file)) : '';

*/


$data = json_encode($request);

$ch = curl_init($server);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data))
    );

$result = curl_exec($ch);

curl_close($ch);

echo $result;


