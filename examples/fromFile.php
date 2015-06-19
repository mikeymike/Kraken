<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\Request\Compress;
use MikeyMike\Kraken\KrakenImage;

$options = new KrakenOptions('api_key', 'api_secret');

// Configure Options
$options->useDevelopment();

$response = Compress::fromFile(
    $options,
    KrakenImage::fromPath('kraken-logo.png')
);

var_dump($krakenResponse);
