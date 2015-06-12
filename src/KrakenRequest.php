<?php

namespace MikeyMike\Kraken;

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;
use MikeyMike\Kraken\KrakenResponse;
use Buzz\Browser;
use Buzz\Message\Response;

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
    public static function compressFromUrl(KrakenOptions $options, Browser $buzz, $url = null)
    {
        if ($url !== null) {
            $options->setSourceImageUrl($url);
        }

        $apiEndpoint = sprintf('%s/v1/url', self::API_URL);

        try {
            $buzz->setClient(new \Buzz\Client\Curl);
            $response = $buzz->post(
                $apiEndpoint,
                ['Content-Type' => 'application/json'],
                json_encode($options->getConfiguredOptions())
            );
        } catch (\Exception $e) {
            var_dump($e->getMessage());
//            throw $e;
        }

        return self::parseResponse($response);
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
        $body = json_decode($response->getContent());
        return new KrakenResponse(
            $response->getStatusCode(),
            $body->success,
            $body->file_name,
            $body->original_size,
            $body->kraked_size,
            $body->saved_bytes,
            $body->kraked_url
        );
    }
}
