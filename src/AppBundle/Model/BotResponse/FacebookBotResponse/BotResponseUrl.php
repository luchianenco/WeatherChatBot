<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;

use AppBundle\Model\BotResponse\BotResponseUrlInterface;

class BotResponseUrl implements BotResponseUrlInterface
{
    const FB_URL = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=PAGE_ACCESS_TOKEN';

    /**
     * @var string
     */
    private $url;

    /**
     * BotResponseUrl constructor.
     * @param string $pageAccessToken
     */
    public function __construct($pageAccessToken)
    {
        $this->url = str_replace('PAGE_ACCESS_TOKEN', $pageAccessToken, self::FB_URL);
    }

    /**
     * @return mixed
     */
    public function getUrl() : string
    {
        return $this->url;
    }
}