<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\Request\Compress;

$options = new KrakenOptions('api_key', 'api_secret');

// Configure Options
$options->useDevelopment();

$response = Compress::fromUrl(
    $options,
    'https://kraken-nekkraug.netdna-ssl.com/assets/images/kraken-logo-4@2x.png'
);

var_dump($krakenResponse);
