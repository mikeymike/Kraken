<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenRequest;
use MikeyMike\Kraken\KrakenImage;

$options = new KrakenOptions('api_key', 'api_secret');

// Configure Options
$options->useDevelopment();

$krakenResponse = KrakenRequest::compressImage(
    $options,
    KrakenImage::fromPath('kraken-logo.png')
);

var_dump($krakenResponse);
