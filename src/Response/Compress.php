<?php

namespace MikeyMike\Kraken\Response;

/**
 * Class KrakenResponse
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class Compress extends Response
{
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
     */
    private function __construct($code, $success)
    {
        $this->code         = $code;
        $this->success      = $success;
    }

    /**
     * @param string $filename
     * @param string $originalSize
     * @param string $krakedSize
     * @param string $savedBytes
     * @param string $krakedUrl
     *
     * @return Response
     */
    public static function success($filename, $originalSize, $krakedSize, $savedBytes, $krakedUrl)
    {
        $response = parent::success();

        $response->filename     = $filename;
        $response->originalSize = $originalSize;
        $response->krakedSize   = $krakedSize;
        $response->savedBytes   = $savedBytes;
        $response->krakedUrl    = $krakedUrl;

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
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return int|null
     */
    public function getOriginalSize()
    {
        return $this->originalSize;
    }

    /**
     * @return int|null
     */
    public function getKrakedSize()
    {
        return $this->krakedSize;
    }

    /**
     * @return int|null
     */
    public function getSavedBytes()
    {
        return $this->savedBytes;
    }

    /**
     * @return string|null
     */
    public function getKrakedUrl()
    {
        return $this->krakedUrl;
    }

    /**
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
    }
}
