# Kraken API Wrapper for PHP

## Installation

```sh
$ composer require mikeymike/kraken:^1.0
```

## Usage

```php

use MikeyMike\Kraken\Kraken;

$kraken = new Kraken('api_key', 'api_secret');

$kraken->compress('http://awesome-website.com/images/header.png');
```

## Tests

Run tests using PHPUnit from the project root.

```sh
$ vendor/bin/phpunit
```