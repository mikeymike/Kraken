<?php

namespace MikeyMike\Kraken;

use MikeyMike\Kraken\KrakenOptions;
use MikeyMike\Kraken\KrakenImage;

/**
 * Class Kraken
 *
 * @package MikeyMike\Kraken
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
class Kraken
{

    /**
     * Base API URL for all requests
     */
    const API_URL = "https://api.kraken.io/";

    /**
     * @var KrakenOptions
     */
    private $options;

    /**
     * @param KrakenOptions $options
     */
    public function __construct(KrakenOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $url
     */
    public function compressFromUrl($url)
    {

    }

    /**
     * @param KrakenImage $image
     */
    public function compressImage(KrakenImage $image)
    {

    }


    private function sendRequest()
    {

    }
}
