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
use MikeyMike\Kraken\Kraken;
use MikeyMike\Kraken\KrakenOptions;
use Buzz\Browser;

$krakenOptions = new KrakenOptions('api_key', 'api_secret');

// Set options using KrakenOptions methods

$krakenResponse = KrakenRequest::compressFromUrl(
    $options,
    new Browser,
    'http://awesome-website.com/images/header.png'
);
```

## Tests

Run tests using PHPUnit from the project root.

```sh
$ vendor/bin/phpunit
```
