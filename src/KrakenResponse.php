<?php

namespace MikeyMike\Kraken;

/**
 * Class KrakenResponse
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class KrakenResponse
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var bool
     */
    private $success;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var int
     */
    private $originalSize;

    /**
     * @var int
     */
    private $krakedSize;

    /**
     * @var int
     */
    private $savedBytes;

    /**
     * @var string
     */
    private $krakedUrl;

    /**
     * KrakenResponse constructor
     *
     * @param int    $code
     * @param bool   $success
     * @param string $filename
     * @param int    $originalSize
     * @param int    $krakedSize
     * @param int    $savedBytes
     * @param string $krake$response->body->dUrl
     */
    public function __construct($code, $success, $filename, $originalSize, $krakedSize, $savedBytes, $krakedUrl)
    {
        $this->code         = $code;
        $this->success      = $success;
        $this->filename     = $filename;
        $this->originalSize = $originalSize;
        $this->krakedSize   = $krakedSize;
        $this->savedBytes   = $savedBytes;
        $this->krakedUrl    = $krakedUrl;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return boolean
     */
    public function wasSuccessful()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return int
     */
    public function getOriginalSize()
    {
        return $this->originalSize;
    }

    /**
     * @param int $originalSize
     */
    public function setOriginalSize($originalSize)
    {
        $this->originalSize = $originalSize;
    }

    /**
     * @return int
     */
    public function getKrakedSize()
    {
        return $this->krakedSize;
    }

    /**
     * @param int $krakedSize
     */
    public function setKrakedSize($krakedSize)
    {
        $this->krakedSize = $krakedSize;
    }

    /**
     * @return int
     */
    public function getSavedBytes()
    {
        return $this->savedBytes;
    }

    /**
     * @param int $savedBytes
     */
    public function setSavedBytes($savedBytes)
    {
        $this->savedBytes = $savedBytes;
    }

    /**
     * @return string
     */
    public function getKrakedUrl()
    {
        return $this->krakedUrl;
    }

    /**
     * @param string $krakedUrl
     */
    public function setKrakedUrl($krakedUrl)
    {
        $this->krakedUrl = $krakedUrl;
    }
}
