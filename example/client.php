<?php

require_once __DIR__ . '/../vendor/autoload.php';

$data = [
    'beam' => ['kirk', 'spock'],
    'to' => 'earth'
];

$outputStream = new \Hawkbit\DataStream\OutputStream($data);

echo 'Capture beaming sequence ' . $outputStream . PHP_EOL . PHP_EOL;
echo 'Beaming sequence ';

sleep(1);

echo 'initiated!' . PHP_EOL;

sleep(1);

echo 'Beaming ';

// perform inter-process communication
// send data via cli, rest, pubsub or something like that
// we send data to endpoint.php and also want to receive data from endpoint php
$payload = exec(sprintf('php endpoint.php %s', $outputStream));

echo 'finished' . PHP_EOL . PHP_EOL;
echo 'Receive beaming feedback sequence ';
sleep(3);

echo $payload . PHP_EOL . PHP_EOL;

// create input stream from input and read data
$inputStream = new \Hawkbit\DataStream\InputStream($payload);
$result = $inputStream->getData();

echo 'Destination: ';

sleep(1);

// check that kirk and spock has been beamed
if($result['destination'] !== $data['to']){
    echo 'Not OK!' . PHP_EOL;
    echo sprintf('Oh no! Expected destination to be %s and not %s', $data['to'],
        $result['destination']) . PHP_EOL;
}

echo 'OK!' . PHP_EOL;

$beam = implode(' and ', $data['beam']);
$beamed = implode(' and ', $result['beamed']);

echo 'Persons: ';

sleep(2);

if($beam !== $beamed){
    echo 'Not OK!' . PHP_EOL;
    echo sprintf('Oh no! Expected beamed persons to be %s and not %s', $beam, $beamed) . PHP_EOL;
}

echo 'OK!' . PHP_EOL . PHP_EOL;

usleep(800);

echo sprintf('%s beamed to %s', $beamed, $result['destination']);



