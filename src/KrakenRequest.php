<?php

namespace MikeyMike\Kraken;

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;
use MikeyMike\Kraken\KrakenResponse;
use Curl\Curl;

/**
 * Class KrakenRequest
 *
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class KrakenRequest
{

    /**
     * Base API URL for all requests
     */
    const API_URL = "https://api.kraken.io";

    /**
     * @param KrakenOptions $options
     * @param string|null   $url
     *
     * @return KrakenResponse
     */
    public static function compressFromUrl(KrakenOptions $options, $url = null)
    {
        if ($url !== null) {
            $options->setSourceImageUrl($url);
        }

        $apiEndpoint = sprintf('%s/v1/url', self::API_URL);

        $curl = new Curl();
        $curl->post($apiEndpoint, json_encode($options->getConfiguredOptions()));

        return self::parseResponse($curl);
    }

    /**
     * @param KrakenOptions $options
     * @param KrakenImage   $image
     *
     * @return KrakenResponse
     */
    public static function compressImage(KrakenOptions $options, KrakenImage $image)
    {
        $apiEndpoint = sprintf('%s/v1/upload', self::API_URL);

        $file = class_exists('CURLFile')
            ? new \CURLFile($image->getPath())
            : sprintf('@%s', $image->getPath());

        $curl = new Curl();
        $curl->post($apiEndpoint, [
           'file' => $file,
           'data' => json_encode($options->getConfiguredOptions())
        ]);

        return self::parseResponse($curl);
    }

    /**
     * Convert Curl response to KrakenResponse
     *
     * @param Curl $response
     *
     * @return KrakenResponse
     */
    private function parseResponse(Curl $curl)
    {
        if ($curl->error) {
            return KrakenResponse::error($curl->error_code, $curl->error_message);
        }

        return KrakenResponse::success(
            $curl->response->file_name,
            $curl->response->original_size,
            $curl->response->kraked_size,
            $curl->response->saved_bytes,
            $curl->response->kraked_url
        );
    }
}
