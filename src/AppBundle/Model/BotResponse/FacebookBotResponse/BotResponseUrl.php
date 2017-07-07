<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;

use AppBundle\Model\BotResponse\BotResponseUrlInterface;

class BotResponseUrl implements BotResponseUrlInterface
{
    const FB_URL_PROFILE = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=PAGE_ACCESS_TOKEN';

    const FB_URL_MESSAGE = 'https://graph.facebook.com/v2.6/me/messages?access_token=PAGE_ACCESS_TOKEN';

    /**
     * @var string
     */
    private $url;

    /**
     * BotResponseUrl constructor.
     * @param $url
     */
    private function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Create Profile Message
     * @param $token
     * @return BotResponseUrl
     */
    public static function createProfileUrl($token)
    {
        $url = str_replace('PAGE_ACCESS_TOKEN', $token, self::FB_URL_PROFILE);

        return new BotResponseUrl($url);
    }

    /**
     * Create Message URL
     * @param $token
     * @return BotResponseUrl
     */
    public static function createMessageUrl($token)
    {
        $url = str_replace('PAGE_ACCESS_TOKEN', $token, self::FB_URL_MESSAGE);

        return new BotResponseUrl($url);
    }

    /**
     * @return mixed
     */
    public function getUrl() : string
    {
        return $this->url;
    }
}