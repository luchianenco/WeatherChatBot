<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;


class BotResponseUrl
{
    const FB_URL = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=PAGE_ACCESS_TOKEN';

    /**
     * @var string
     */
    private $url;

    /**
     * BotResponseUrl constructor.
     * @param $accessToken
     */
    private function __construct($accessToken)
    {
        $this->url = str_replace('PAGE_ACCESS_TOKEN', $accessToken, self::FB_URL);
    }

    /**
     * @param $accessToken
     * @return BotResponseUrl
     */
    public static function createWithAccessToken($accessToken)
    {
        return new self($accessToken);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}