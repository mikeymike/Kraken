<?php

namespace MikeyMike\Kraken;

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;
use MikeyMike\Kraken\KrakenResponse;
use Unirest\Request;
use Unirest\Response;

/**
 * Class Kraken
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
     * @param null $url
     *
     * @return KrakenResponse
     */
    public static function compressFromUrl(KrakenOptions $options, $url = null)
    {
        if ($url !== null) {
            $options->setSourceImageUrl($url);
        }

        $apiEndpoint = sprintf('%s/v1/url', self::API_URL);

        $response = Request::post($apiEndpoint, [], json_encode($options->getConfiguredOptions()));

        return $response;
//        return self::parseResponse($response);
    }

    /**
     * @param KrakenImage $image
     */
    public function compressImage(KrakenImage $image)
    {

    }

    /**
     * Convert Unirest response to KrakenResponse
     *
     * @param Response $response
     *
     * @return \MikeyMike\Kraken\KrakenResponse
     */
    private static function parseResponse(Response $response)
    {
        // TODO: Handle when Response is not stdClass etc
        return new KrakenResponse(
            $response->code,
            $response->body->success,
            $response->body->filename,
            $response->body->original_size,
            $response->body->kraked_size,
            $response->body->saved_bytes,
            $response->body->kraked_url
        );
    }
}
