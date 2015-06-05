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

        $krakenOptions->setLossy(true, 70);

        $this->assertSame(
            [
                'auth'    => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'lossy'   => true,
                'quality' => 70
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetLossyToFalse()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->setLossy(false);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanChangeLossyConfigurationAfterSetting()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->setLossy(true, 50);
        $krakenOptions->setLossy(true);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'lossy' => true
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanUseWebP()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->useWebP(true);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'webp' => true
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanChangeWebpConfiguration()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->useWebP(true);
        $krakenOptions->useWebP(false);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanUseWebpAndLossyConversion()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->useWebP(true);
        $krakenOptions->setLossy(true);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'webp'  => true,
                'lossy' => true
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetDevelopment()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->useDevelopment(true);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'dev'  => true
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanChangeDevelopmentConfiguration()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->useDevelopment(true);
        $krakenOptions->useDevelopment(false);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetWaitOption()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->waitForResponse(true);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'wait'  => true
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanChangeWaitConfiguration()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->waitForResponse(true);
        $krakenOptions->waitForResponse(false);

        $this->assertSame(
            [
                'auth'  => [
                    'api_key'    => 'fake_key',
                    'api_secret' => 'fake_secret'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }


}
