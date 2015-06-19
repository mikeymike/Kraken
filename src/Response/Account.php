<?php

namespace MikeyMike\Kraken\Response;

/**
 * Class KrakenResponse
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class Account extends Response
{
    /**
     * @var array
     */
    protected $subAccounts = [];

    /**
     * @var array|null
     */
    protected $subAccount;

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
     * @param array $subAccounts
     * @param null  $subAccount
     *
     * @return Account
     */
    public static function success($subAccounts = [], $subAccount = null)
    {
        $response = new self(200, true);

        $response->subAccounts = $subAccounts;
        $response->subAccount  = $subAccount;

        return $response;
    }

    /**
     * @param $code
     * @param $reason
     *
     * @return AccountResponse
     */
    public static function error($code, $reason)
    {
        $response = new self($code, false);

        $response->error = $reason;

        return $response;
    }
}
