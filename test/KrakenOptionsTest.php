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

    public function testCanSaveToAmazonS3()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->saveToAmazonS3('key', 'secret', 'bucket', 'region');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                's3_store' => [
                    'key' => 'key',
                    'secret' => 'secret',
                    'bucket' => 'bucket',
                    'region' => 'region'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSaveToRackspace()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->saveToRackspace('user', 'key', 'container');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'cf_store' => [
                    'user' => 'user',
                    'key' => 'key',
                    'container' => 'container'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSaveToAzure()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->saveToAzure('account', 'key', 'container');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'azure_store' => [
                    'account' => 'account',
                    'key' => 'key',
                    'container' => 'container'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testExternalStorageOptionOverwriteEachOther()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions
            ->saveToAmazonS3('key', 'secret', 'bucket', 'region')
            ->saveToRackspace('user', 'key', 'container')
            ->saveToAzure('account', 'key', 'container');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'azure_store' => [
                    'account' => 'account',
                    'key' => 'key',
                    'container' => 'container'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeExact()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeExact(100, 100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'exact',
                    'width' => 100,
                    'height' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizePortrait()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizePortrait(100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'portrait',
                    'height' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeLandscape()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeLandscape(100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'landscape',
                    'width' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeAuto()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeAuto(100, 100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'auto',
                    'width' => 100,
                    'height' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeFit()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeFit(100, 100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'fit',
                    'width' => 100,
                    'height' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeCrop()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeCrop(100, 100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'crop',
                    'width' => 100,
                    'height' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeSquare()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeSquare(100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'square',
                    'size' => 100
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeFillAndDefaultsToWhite()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeFill(100, 100);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'fill',
                    'width' => 100,
                    'height' => 100,
                    'background' => 'rgba(255, 255, 255, 1.0)'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeFillAndCanSetBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeFill(100, 100, 0, 0, 0, .5);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'fill',
                    'width' => 100,
                    'height' => 100,
                    'background' => 'rgba(0, 0, 0, 0.5)'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanSetResizeFillAndCanSeTransparentBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->resizeFill(100, 100, 0, 0, 0, 0);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'fill',
                    'width' => 100,
                    'height' => 100,
                    'background' => 'rgba(0, 0, 0, 0.0)'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testResizeMethodsOverwriteEachOther()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions
            ->resizeSquare(100)
            ->resizeFill(100, 100, 0, 0, 0, .5);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'resize' => [
                    'strategy' => 'fill',
                    'width' => 100,
                    'height' => 100,
                    'background' => 'rgba(0, 0, 0, 0.5)'
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanCovertToGif()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => '#FFFFFF',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanCovertToJpeg()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('jpeg');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'jpeg',
                    'background'     => '#FFFFFF',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testCanCovertToPng()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('png');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'png',
                    'background'     => '#FFFFFF',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testConvertToWillAcceptShortHexBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', '#333');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => '#333',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testConvertToWillAcceptLongHexBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', '#B4DA55');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => '#B4DA55',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testConvertToWillAcceptRgbBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', 'rgb(1, 1, 1)');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => 'rgb(1, 1, 1)',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testConvertToWillAcceptRgbaBackground()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', 'rgba(1, 1, 1, .6)');

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => 'rgba(1, 1, 1, .6)',
                    'keep_extension' => false
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    public function testConvertToAndKeepExtension()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', '#B4DA55', true);

        $this->assertSame(
            [
                'auth' => [
                    'api_key' => 'fake_key',
                    'api_secret' => 'fake_secret'
                ],
                'convert' => [
                    'format'         => 'gif',
                    'background'     => '#B4DA55',
                    'keep_extension' => true
                ]
            ],
            $krakenOptions->getConfiguredOptions()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConvertToWillThrowExceptionOnInvalidType()
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('bad');
    }

    /**
     * @param $invalidBg
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidBackgroundProvider
     */
    public function testConvertToWillThrowExceptionOnInvalidBackgroundValue($invalidBg)
    {
        $krakenOptions = new KrakenOptions('fake_key', 'fake_secret');

        $krakenOptions->convertTo('gif', $invalidBg);
    }

    public function invalidBackgroundProvider()
    {
        return [
            ['rgb(1, 1, 1, 1)'],
            ['rgb(1, 1)'],
            ['rgba(1, 1, 1)'],
            ['rgba(1, 1, 1, 1, 1)'],
            ['#FFFFFFF'],
            ['#FF'],
        ];
    }
}
