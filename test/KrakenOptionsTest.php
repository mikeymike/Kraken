<?php

namespace MikeyMike\Kraken\Test;

use MikeyMike\Kraken\KrakenOptions;

/**
 * Class KrakenOptionsTest
 * @author Michael Woodward <michael@wearejh.com>
 */
class KrakenOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSetLossyWithQuality()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');
        $this->assertTrue(true);
    }
}