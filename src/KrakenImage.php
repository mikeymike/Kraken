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