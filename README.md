# Kraken API Wrapper for PHP

## Installation

_WIP: Not ready for usage_

```sh
$ composer require mikeymike/kraken
```

## Usage

See examples for different use cases. 

Common use case, compress from url: 
```php
use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\Request\Compress;

$options = new KrakenOptions('api_key', 'api_secret');

// Set options using KrakenOptions methods

$response = Compress::fromUrl(
    $options,
    'https://kraken-nekkraug.netdna-ssl.com/assets/images/kraken-logo-4@2x.png'
);
```

## Tests

Run tests using PHPUnit from the project root.

```sh
$ vendor/bin/phpunit
```
