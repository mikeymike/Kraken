# Kraken API Wrapper for PHP

## Installation

_WIP: Not ready for usage_

```sh
$ composer require mikeymike/kraken:^1.0
```

## Usage

```php
use MikeyMike\Kraken\Kraken;
use MikeyMike\Kraken\KrakenOptions;

$krakenOptions = new KrakenOptions('api_key', 'api_secret');

// Set options using KrakenOptions methods

$kraken = new Kraken($krakenOptions);
$kraken->compressUrl('http://awesome-website.com/images/header.png');
```

## Tests

Run tests using PHPUnit from the project root.

```sh
$ vendor/bin/phpunit
```