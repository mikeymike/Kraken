<?php

namespace MikeyMike\Kraken;

/**
 * Class KrakenOptions
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class KrakenOptions
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var array
     */
    private $options = [
        'lossy' => true,
        'dev'   => false,
        'webp'  => false
    ];

    /**
     * Initialise the API class
     *
     * @param string $apiKey
     * @param string $apiSecret
     * @param array  $options
     */
    public function __construct($apiKey, $apiSecret, $options = [])
    {
        $this->apiKey     = $apiKey;
        $this->apiSecret  = $apiSecret;

        $this->processOptions($options);
    }

    /**
     * @param array $options
     * @throws \InvalidArgumentException on invalid option key
     */
    private function processOptions($options = [])
    {
        foreach ($options as $option => $value) {

            switch ($option) {
                case 'lossy':

                    break;
                case 'dev':

                    break;
                case 'webp':

                    break;
                case 'wait':

                    break;
                case 's3_store':

                    break;
                case 'cf_store':

                    break;
                case 'azure_store':

                    break;
                case 'resize':

                    break;

                default:
                    throw new \InvalidArgumentException(sprintf('Invalid option passed %s', $option));
            }
        }
    }

    /**
     * @param bool $useLossy
     * @param int  $quality
     *
     * @return $this
     */
    public function setLossy($useLossy = true, $quality = 100)
    {
        $this->options['lossy'] = (bool) $useLossy;

        if ($useLossy) {
            $this->options['quality'] = (int) $quality;
        } else {
            unset($this->options['quality']);
        }

        return $this;
    }

    /**
     * @param bool $useWebP
     *
     * @return $this
     */
    public function useWebP($useWebP = true)
    {
        $this->options['webp'] = (bool) $useWebP;

        return $this;
    }

    /**
     * @param bool $useDevelopment
     *
     * @return $this
     */
    public function useDevelopment($useDevelopment = true)
    {
        $this->options['dev'] = (bool) $useDevelopment;

        return $this;
    }

    /**
     * @param bool $useWait
     * @return $this
     */
    public function waitForResponse($useWait = true)
    {
        $this->options['wait'] = (bool) $useWait;

        return $this;
    }

    /**
     * @param string $key
     * @param string $secret
     * @param string $bucket
     * @param string $region
     *
     * @return $this
     */
    public function saveToAmazonS3($key, $secret, $bucket, $region)
    {
        $this->cleanStorageOptions();

        $this->options['s3_store'] = [
            'key'    => $key,
            'secret' => $secret,
            'bucket' => $bucket,
            'region' => $region
        ];

        return $this;
    }

    /**
     * @param string $user
     * @param string $key
     * @param string $container
     *
     * @return $this
     */
    public function saveToRackspace($user, $key, $container)
    {
        $this->cleanStorageOptions();

        $this->options['cf_store'] = [
            'user'      => $user,
            'key'       => $key,
            'container' => $container
        ];

        return $this;
    }

    /**
     * @param string $account
     * @param string $key
     * @param string $container
     *
     * @return $this
     */
    public function saveToAzure($account, $key, $container)
    {
        $this->cleanStorageOptions();

        $this->options['azure_store'] = [
            'account'   => $account,
            'key'       => $key,
            'container' => $container
        ];

        return $this;
    }

    /**
     * Remove storage options
     */
    private function cleanStorageOptions()
    {
        unset($this->options['s3_store']);
        unset($this->options['cf_store']);
        unset($this->options['azure_store']);
    }

    /**
     * Resize to exact width and height. Aspect ratio will not be maintained
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function resizeExact($width, $height)
    {
        $this->resize([
            'strategy' => 'exact',
            'width'    => $width,
            'height'   => $height
        ]);

        return $this;
    }

    /**
     * Exact height will be set, width will be adjusted according to aspect ratio
     *
     * @param int $height
     *
     * @return $this
     */
    public function resizePortrait($height)
    {
        $this->resize([
            'strategy' => 'portrait',
            'height'   => $height
        ]);

        return $this;
    }

    /**
     * Exact width will be set, height will be adjusted according to aspect ratio
     *
     * @param int $width
     *
     * @return $this
     */
    public function resizeLandscape($width)
    {
        $this->resize([
            'strategy' => 'landscape',
            'width'    => $width
        ]);

        return $this;
    }

    /**
     * The best strategy (portrait or landscape) will be selected for a given image according to its aspect ratio
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function resizeAuto($width, $height)
    {
        $this->resize([
            'strategy' => 'auto',
            'width'    => $width,
            'height'   => $height
        ]);

        return $this;
    }

    /**
     * This option will crop and resize your images to fit the desired width and height
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function resizeFit($width, $height)
    {
        $this->resize([
            'strategy' => 'fit',
            'width'    => $width,
            'height'   => $height
        ]);

        return $this;
    }

    /**
     * This option will crop your images to the exact size you specify with no distortion
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function resizeCrop($width, $height)
    {
        $this->resize([
            'strategy' => 'crop',
            'width'    => $width,
            'height'   => $height
        ]);

        return $this;
    }

    /**
     * This strategy will first crop the image by its shorter dimension
     * to make it a square, then resize it to the specified size
     *
     * @param int $size
     *
     * @return $this
     */
    public function resizeSquare($size)
    {
        $this->resize([
            'strategy' => 'square',
            'size'     => $size
        ]);

        return $this;
    }

    /**
     * This strategy allows you to resize the image to fit the specified bounds
     * while preserving the aspect ratio (just like auto strategy).
     * The optional background property allows you to specify a color which will
     * be used to fill the unused portions of the previously specified bounds.
     * The background property is formatted in RGBA "rgba(91, 126, 156, 0.7)".
     * The default background color is white
     *
     * @param int $width
     * @param int $height
     * @param int $r
     * @param int $g
     * @param int $b
     * @param int $a
     *
     * @return $this
     */
    public function resizeFill($width, $height, $r = 255, $g = 255, $b = 255, $a = 1)
    {
        $this->resize([
            'strategy'   => 'fill',
            'width'      => $width,
            'height'     => $height,
            'background' => sprintf('rgba(%d, %d, %d, %d)', $r, $g, $b, $a)
        ]);

        return $this;
    }
    
    /**
     * Internal resize function for resize strategy functions
     *
     * @param array $resizeOptions
     */
    private function resize($resizeOptions = [])
    {
        $this->options['resize'] = $resizeOptions;
    }

    /**
     * @param string      $format
     * @param null|string $background
     * @param bool        $keepExtension
     *
     * @return $this
     */
    public function convertTo($format, $background = '#FFFFFF', $keepExtension = false)
    {
        $allowedFormats = ['jpeg', 'png', 'gif'];

        if (!in_array($format, $allowedFormats)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid format %s, must be one of %s', $format, implode(',', $allowedFormats))
            );
        }

        // Regex will match hex, rgb, rgba colour options
        $bgRegex = '/rgb\((\d{1,3}),\s?(\d{1,3}),\s?(\d{1,3})\)';
        $bgRegex .= '|rgba\((\d{1,3}),\s?(\d{1,3}),\s?(\d{1,3}),\s?(\d)?\.?(\d)\)';
        $bgRegex .= '|#([a-fA-F0-9]{3}){1,2}\b/';

        if (!preg_match($bgRegex, $background)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid background value %s, must be a valid hex, rgb or rgba string', $background)
            );
        }

        $this->options['convert'] = [
            'format'         => $format,
            'background'     => $background,
            'keep_extension' => (bool) $keepExtension
        ];

        return $this;
    }
}
