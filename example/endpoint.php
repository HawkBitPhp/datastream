<?php

require_once __DIR__ . '/../vendor/autoload.php';

// read payload for input stream
$payload = $argv[1];

// create input stream
$inputStream = new \Hawkbit\DataStream\InputStream($payload);
$data = $inputStream->getData();

$output = [
    'beamed' => $data['beam'],
    'destination' => $data['to']
];

echo new \Hawkbit\DataStream\OutputStream($output);
exit(1);
