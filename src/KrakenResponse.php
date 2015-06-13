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
     * @var string
     */
    private $error;

    /**
     * KrakenResponse constructor
     *
     * @param int    $code
     * @param bool   $success
     */
    private function __construct($code, $success)
    {
        $this->code         = $code;
        $this->success      = $success;
    }

    /**
     * @param $filename
     * @param $originalSize
     * @param $krakedSize
     * @param $savedBytes
     * @param $krakedUrl
     *
     * return KrakenResponse
     */
    public static function success($filename, $originalSize, $krakedSize, $savedBytes, $krakedUrl)
    {
        $response = new self(200, true);

        $response->filename     = $filename;
        $response->originalSize = $originalSize;
        $response->krakedSize   = $krakedSize;
        $response->savedBytes   = $savedBytes;
        $response->krakedUrl    = $krakedUrl;

        return $response;
    }

    /**
     * @param $code
     * @param $reason
     *
     * @return KrakenResponse
     */
    public static function error($code, $reason)
    {
        $response = new self($code, false);

        $response->error = $reason;

        return $response;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return boolean
     */
    public function wasSuccessful()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return int
     */
    public function getOriginalSize()
    {
        return $this->originalSize;
    }

    /**
     * @return int
     */
    public function getKrakedSize()
    {
        return $this->krakedSize;
    }

    /**
     * @return int
     */
    public function getSavedBytes()
    {
        return $this->savedBytes;
    }

    /**
     * @return string
     */
    public function getKrakedUrl()
    {
        return $this->krakedUrl;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}
