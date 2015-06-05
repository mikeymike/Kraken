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
     * @return KrakenImage
     */
    public static function fromPath($path)
    {
        return new self($path);
    }
}