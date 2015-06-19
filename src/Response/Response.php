<?php

namespace MikeyMike\Kraken\Response;

/**
 * Class Response
 * @author Michael Woodward <michael@wearejh.com>
 */
class Response
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $error;

    /**
     * Respnse constructor
     *
     * @param int  $code
     * @param bool $success
     */
    private function __construct($code, $success)
    {
        $this->code         = $code;
        $this->success      = $success;
    }

    /**
     * return Response
     */
    public static function success()
    {
        return new self(200, true);
    }

    /**
     * @param int    $code
     * @param string $reason
     *
     * @return Response
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
}
