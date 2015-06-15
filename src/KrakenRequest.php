<?php

namespace MikeyMike\Kraken;

use Buzz\Message\Form\FormUpload;
use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;
use MikeyMike\Kraken\KrakenResponse;
use Buzz\Browser;
use Buzz\Message\Response;
use Buzz\Exception\ClientException;

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
     * @param Browser       $buzz
     * @param string|null   $url
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
        } catch (ClientException $e) {
            var_dump($e->getMessage());
//            throw $e;
        }

        return self::parseResponse($response);
    }

    /**
     * @param KrakenOptions $options
     * @param Browser       $buzz
     * @param KrakenImage   $image
     *
     * @return KrakenResponse
     */
    public static function compressImage(KrakenOptions $options, Browser $buzz, KrakenImage $image)
    {
        $apiEndpoint = sprintf('%s/v1/url', self::API_URL);

        // TODO: THIS

        $buzz->setClient(new \Buzz\Client\Curl);
        $response = $buzz->post(
            $apiEndpoint,
            ['Content-Type' => 'application/json'],
            json_encode($options->getConfiguredOptions())
        );

        return self::parseResponse($response);
    }

    /**
     * Convert Buzz response to KrakenResponse
     *
     * @param Response $response
     *
     * @return KrakenResponse
     */
    private function parseResponse(Response $response)
    {
        $body = json_decode($response->getContent());

        if ($response->getStatusCode() === 200) {
            return KrakenResponse::success(
                $body->file_name,
                $body->original_size,
                $body->kraked_size,
                $body->saved_bytes,
                $body->kraked_url
            );
        }

        return KrakenResponse::error($response->getStatusCode(), $body->error);
    }
}
