<?php

namespace MikeyMike\Kraken\Request;

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;
use MikeyMike\Kraken\Response\Compress as CompressResponse;
use Curl\Curl;

/**
 * Class Compress
 *
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class Compress
{

    /**
     * Base API URL for all requests
     */
    const API_URL = "https://api.kraken.io/v1";

    /**
     * @param KrakenOptions $options
     * @param string|null   $url
     *
     * @return CompressResponse
     */
    public static function fromUrl(KrakenOptions $options, $url = null)
    {
        if ($url !== null) {
            $options->setSourceImageUrl($url);
        }

        $apiEndpoint = sprintf('%s/url', self::API_URL);

        $curl = new Curl();
        $curl->post($apiEndpoint, json_encode($options->getConfiguredOptions()));

        return self::parseResponse($curl);
    }

    /**
     * @param KrakenOptions $options
     * @param KrakenImage   $image
     *
     * @return CompressResponse
     */
    public static function fromFile(KrakenOptions $options, KrakenImage $image)
    {
        $apiEndpoint = sprintf('%s/upload', self::API_URL);

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
     * @param Curl $curl
     *
     * @return CompressResponse
     */
    private function parseResponse(Curl $curl)
    {
        if ($curl->error) {
            return CompressResponse::error($curl->error_code, $curl->error_message);
        }

        return CompressResponse::success(
            $curl->response->file_name,
            $curl->response->original_size,
            $curl->response->kraked_size,
            $curl->response->saved_bytes,
            $curl->response->kraked_url
        );
    }
}
