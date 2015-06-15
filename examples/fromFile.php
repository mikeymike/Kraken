<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenRequest;
use MikeyMike\Kraken\KrakenImage;
use Buzz\Browser;

$options = new KrakenOptions('api_key', 'api_secret');

// Configure Options
$options->useDevelopment();

$krakenResponse = KrakenRequest::compressImage(
    $options,
    new Browser,
    KrakenImage::fromPath('')
);

var_dump($krakenResponse);
