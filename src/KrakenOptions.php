<?php

namespace MikeyMike\Kraken;

/**
 * Class KrakenOptions
 *
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class KrakenOptions
{
    /**
     * @var array
     */
    private $options = [
        'wait' => true
    ];

    /**
     * Initialise the API class
     *
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct($apiKey, $apiSecret)
    {
        $this->setAuth($apiKey, $apiSecret);
    }

    /**
     * @param $apiKey
     * @param $apiSecret
     */
    private function setAuth($apiKey, $apiSecret)
    {
        $this->options['auth'] = [
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret
        ];
    }


    public function setSourceImageUrl($url)
    {
        // TODO: Publically Accesible Validate URL ??

        $this->options['url'] = $url;

        return $this;
    }
    
    /**
     * Apply lossy optimisation to the image
     *
     * Quality 'auto' will use Krakens intelligent lossy optimization scheme,
     * meaning Kraken will intelligently pick the best quality to size ratio for every single image
     *
     * @param bool       $useLossy
     * @param int|string $quality
     *
     * @return $this
     */
    public function setLossy($useLossy = true, $quality = 'auto')
    {
        if (!$useLossy) {
            unset($this->options['lossy']);
            unset($this->options['quality']);

            return $this;
        }

        $this->options['lossy'] = (bool) $useLossy;

        if ($quality === 'auto') {
            unset($this->options['quality']);
        } else {
            $this->options['quality'] = (int) $quality;
        }

        return $this;
    }

    /**
     * Convert to WebP format. Optionally use setLossy method to
     * apply a lossy conversion.
     *
     * @param bool $useWebP
     *
     * @return $this
     */
    public function useWebP($useWebP = true)
    {
        if ($useWebP) {
            $this->options['webp'] = (bool) $useWebP;
        } else {
            unset($this->options['webp']);
        }

        return $this;
    }

    /**
     * @param bool $useDevelopment
     *
     * @return $this
     */
    public function useDevelopment($useDevelopment = true)
    {
        if ($useDevelopment) {
            $this->options['dev'] = (bool)$useDevelopment;
        } else {
            unset($this->options['dev']);
        }

        return $this;
    }

    /**
     * @param bool $useWait
     * @return $this
     */
    public function waitForResponse($useWait = true)
    {
        if ($useWait) {
            $this->options['wait'] = (bool)$useWait;
        } else {
            unset($this->options['wait']);
        }

        return $this;
    }

    // TODO: Set callback URL, will replace waitForResponse and vice versa

    /**
     * @param string $key
     * @param string $secret
     * @param string $bucket
     * @param string $region
     * @param string $path
     * @param bool   $public
     * @param array  $headers
     *
     * @return $this
     */
    public function saveToAmazonS3($key, $secret, $bucket, $region, $path = '/', $public = true, $headers = [])
    {
        $this->cleanStorageOptions();

        $this->options['s3_store'] = [
            'key'     => $key,
            'secret'  => $secret,
            'bucket'  => $bucket,
            'region'  => $region,
            'path'    => $path,
            'acl'     => $public ? 'public_read' : 'private',
            'headers' => $headers
        ];

        return $this;
    }

    /**
     * @param string $user
     * @param string $key
     * @param string $container
     * @param string $path
     *
     * @return $this
     */
    public function saveToRackspace($user, $key, $container, $path = '/')
    {
        $this->cleanStorageOptions();

        $this->options['cf_store'] = [
            'user'      => $user,
            'key'       => $key,
            'container' => $container,
            'path'      => $path
        ];

        return $this;
    }

    /**
     * @param string $account
     * @param string $key
     * @param string $container
     * @param string $path
     *
     * @return $this
     */
    public function saveToAzure($account, $key, $container, $path = '/')
    {
        $this->cleanStorageOptions();

        $this->options['azure_store'] = [
            'account'   => $account,
            'key'       => $key,
            'container' => $container,
            'path'      => $path
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
     * @param int       $width
     * @param int       $height
     * @param int       $r
     * @param int       $g
     * @param int       $b
     * @param int|float $a
     *
     * @return $this
     */
    public function resizeFill($width, $height, $r = 255, $g = 255, $b = 255, $a = 1)
    {
        $this->resize([
            'strategy'   => 'fill',
            'width'      => $width,
            'height'     => $height,
            'background' => sprintf('rgba(%d, %d, %d, %.1f)', $r, $g, $b, $a)
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
     * Convert different images from one type/format to another
     *
     * format         The image format you wish to convert your image into.
     *                This can accept one of the following values: jpeg, png or gif.
     *
     * background     Background image when converting from transparent
     *                file formats like PNG or GIF into fully opaque format
     *                like JPEG. The background property can be passed in HEX
     *                notation "#f60" or "#ff6600", RGB "rgb(255, 0, 0)"
     *                or RGBA "rgba(91, 126, 156, 0.7)". The default background color is white.
     *
     * keep_extension A boolean value (true or false) instructing Kraken API
     *                whether or not the original extension should be kept
     *                in the output filename. For example when converting "image.jpg"
     *                into PNG format with this flag turned on the output image name
     *                will still be "image.jpg" even though the image has been
     *                converted into a PNG. The default value is false meaning the
     *                correct extension will always be set.
     *
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

    /**
     * Get the built options array
     *
     * @return array
     */
    public function getConfiguredOptions()
    {
        return $this->options;
    }
}
