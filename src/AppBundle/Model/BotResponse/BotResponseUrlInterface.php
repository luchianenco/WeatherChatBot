<?php


namespace AppBundle\Model\BotResponse;


interface BotResponseUrlInterface
{

    /**
     * BotResponseUrl constructor.
     * @param string $pageAccessToken
     */
    public function __construct($pageAccessToken);

    /**
     * Get Url
     * @return mixed
     */
    public function getUrl() : string;
}