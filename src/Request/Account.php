<?php

namespace MikeyMike\Kraken\Request;

use MikeyMike\Kraken\Response\Account as AccountResponse;
use Curl\Curl;

/**
 * Class Account
 *
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class Account
{
    /**
     * Base API URL for all requests
     */
    const API_URL = "https://api.kraken.io/v1";

    /**
     * @param string $apiKey
     * @param string $apiSecret
     *
     * @return AccountResponse
     */
    public static function getSubAccounts($apiKey, $apiSecret)
    {
        $apiEndpoint = sprintf('%s/subaccounts', self::API_URL);

        $curl = new Curl();
        $curl->get($apiEndpoint, json_encode([
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret
        ]));

        return self::parseResponse($curl);
    }

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param int    $subAccountId
     *
     * @return AccountResponse
     */
    public static function getSubAccount($apiKey, $apiSecret, $subAccountId)
    {
        $apiEndpoint = sprintf('%s/subaccounts/%s', self::API_URL, $subAccountId);

        $curl = new Curl();
        $curl->get($apiEndpoint, json_encode([
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret
        ]));

        return self::parseResponse($curl);
    }

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param string $subAccountName
     *
     * @return AccountResponse
     */
    public static function createSubAccount($apiKey, $apiSecret, $subAccountName)
    {
        $apiEndpoint = sprintf('%s/subaccounts', self::API_URL);

        $curl = new Curl();
        $curl->post($apiEndpoint, json_encode([
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret,
            'name'       => $subAccountName
        ]));

        return self::parseResponse($curl);
    }

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param int    $subAccountId
     *
     * @return AccountResponse
     */
    public static function deleteSubAccount($apiKey, $apiSecret, $subAccountId)
    {
        $apiEndpoint = sprintf('%s/subaccounts/%s', self::API_URL, $subAccountId);

        $curl = new Curl();
        $curl->delete($apiEndpoint, json_encode([
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret
        ]));

        return self::parseResponse($curl);
    }

    /**
     * Convert Curl response to KrakenResponse
     *
     * @param Curl $curl
     *
     * @return AccountResponse
     */
    private function parseResponse(Curl $curl)
    {
        if ($curl->error) {
            return AccountResponse::error($curl->error_code, $curl->error_message);
        }

        return AccountResponse::success(
            $curl->response->subaccounts ?: [],
            $curl->response->subaccount  ?: null
        );
    }
}
