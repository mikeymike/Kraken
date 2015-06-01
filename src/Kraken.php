<?php

namespace MikeyMike\Kraken;

use MikeyMike\Kraken\KrakenOptions;

/**
 * Class Kraken
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
        $this->setOptions($options);
    }

    /**
     * Validate and set API options
     *
     * @param KrakenOptions $options
     */
    public function setOptions(KrakenOptions $options)
    {
        if (!$options->validate()) {
            throw new \InvalidArgumentException('Options are invalid');
        }

        $this->options = $options;
    }

    // TODO: Compress / Call API
}
