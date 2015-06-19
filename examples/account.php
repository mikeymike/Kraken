<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use MikeyMike\Kraken\Request\Account;

$response = Account::getSubAccounts('api_key', 'api_secret');

var_dump($response);
