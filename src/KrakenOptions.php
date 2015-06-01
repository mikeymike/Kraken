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
        $this->options    = array_merge_recursive($this->options, $options);
    }

    /**
     * Check the options are valid
     *
     * @return bool
     */
    public function validate()
    {
        // TODO: VALIDATE
        return true;
    }

    /**
     * @param bool $useLossy
     * @return $this
     */
    public function setUseLossy($useLossy = true)
    {
        $this->options['lossy'] = (bool) $useLossy;

        return $this;
    }

    /**
     * @param bool $useWebP
     * @return $this
     */
    public function setUseWebP($useWebP = true)
    {
        $this->options['webp'] = (bool) $useWebP;

        return $this;
    }

    /**
     * @param bool $useDevelopment
     * @return $this
     */
    public function setUseDevelopment($useDevelopment = true)
    {
        $this->options['dev'] = (bool) $useDevelopment;

        return $this;
    }

    /**
     * @param bool $useWait
     * @return $this
     */
    public function setUseWait($useWait = true)
    {
        $this->options['wait'] = (bool) $useWait;

        return $this;
    }

    /**
     * @param string $key
     * @param string $secret
     * @param string $bucket
     * @param string $region
     * @return $this
     */
    public function useAmazonS3($key, $secret, $bucket, $region)
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
     * @param $account
     * @param $key
     * @param $container
     * @return $this
     */
    public function useRackspace($user, $key, $container)
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
     * @param $account
     * @param $key
     * @param $container
     * @return $this
     */
    public function useAzure($account, $key, $container)
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
     */
    public function useResizeExact($width, $height)
    {
        $this->useResize([
            'strategy' => 'exact',
            'width'    => $width,
            'height'   => $height
        ]);
    }

    /**
     * Exact height will be set, width will be adjusted according to aspect ratio
     *
     * @param int $height
     */
    public function useResizePortrait($height)
    {
        $this->useResize([
            'strategy' => 'portrait',
            'height'   => $height
        ]);
    }

    /**
     * Exact width will be set, height will be adjusted according to aspect ratio
     *
     * @param int $width
     */
    public function useResizeLandscape($width)
    {
        $this->useResize([
            'strategy' => 'landscape',
            'width'    => $width
        ]);
    }

    /**
     * The best strategy (portrait or landscape) will be selected for a given image according to its aspect ratio
     *
     * @param int $width
     * @param int $height
     */
    public function useResizeAuto($width, $height)
    {
        $this->useResize([
            'strategy' => 'auto',
            'width'    => $width,
            'height'   => $height
        ]);
    }

    /**
     * This option will crop and resize your images to fit the desired width and height
     *
     * @param int $width
     * @param int $height
     */
    public function useResizeFit($width, $height)
    {
        $this->useResize([
            'strategy' => 'fit',
            'width'    => $width,
            'height'   => $height
        ]);
    }

    /**
     * This option will crop your images to the exact size you specify with no distortion
     *
     * @param int $width
     * @param int $height
     */
    public function useResizeCrop($width, $height)
    {
        $this->useResize([
            'strategy' => 'crop',
            'width'    => $width,
            'height'   => $height
        ]);
    }

    /**
     * This strategy will first crop the image by its shorter dimension
     * to make it a square, then resize it to the specified size
     *
     * @param int $size
     */
    public function useResizeSquare($size)
    {
        $this->useResize([
            'strategy' => 'square',
            'size'     => $size
        ]);
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
     */
    public function useResizeFill($width, $height, $r = 255, $g = 255, $b = 255, $a = 1)
    {
        $this->useResize([
            'strategy'   => 'fill',
            'width'      => $width,
            'height'     => $height,
            'background' => sprintf('rgba(%d, %d, %d, %d)', $r, $g, $b, $a)
        ]);
    }
    
    /**
     * Internal resize function for resize strategy functions
     * TODO: Pointless?
     * @param array $resizeOptions
     */
    private function useResize($resizeOptions = [])
    {
        $this->options['resize'] = $resizeOptions;
    }
}
