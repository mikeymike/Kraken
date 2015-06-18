<?php

namespace MikeyMike\Kraken;

/**
 * Class KrakenImage
 *
 * @package MikeyMike\Kraken
 * @author  Michael Woodward <michael@wearejh.com>
 */
class KrakenImage
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $path
     */
    private function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Factory method from path
     *
     * @param string $path
     *
     * @return KrakenImage
     * @throws \InvalidArgumentException
     */
    public static function fromPath($path)
    {
        $path = realpath($path);

        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('No valid file at path %s', $path));
        }

        $supportedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];

        if (!in_array(exif_imagetype($path), $supportedTypes)) {
             throw new \InvalidArgumentException('Unsupported image type');
        }

        return new self($path);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}