<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenRequest;

$options = new KrakenOptions('api_key', 'api_secret');

// Configure Options
$options->useDevelopment();

$krakenResponse = KrakenRequest::compressFromUrl(
    $options,
    'https://kraken-nekkraug.netdna-ssl.com/assets/images/kraken-logo-4@2x.png'
);

var_dump($krakenResponse);
