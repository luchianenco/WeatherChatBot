<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;
use Buzz\Browser;

/**
 * Facebook Bot Client
 * @package AppBundle\Service\BotClient
 */
class FacebookBotClient implements BotClientInterface
{
    const FB_URL = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=PAGE_ACCESS_TOKEN';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var mixed
     */
    private $url;

    /**
     * @var Browser
     */
    private $browser;

    // TODO remove direct dependancy on Browser class
    // TODO make abstract layer
    public function __construct(Browser $browser, $accessToken)
    {
        $this->browser = $browser;
        $this->accessToken = $accessToken;
        $this->url = str_replace('PAGE_ACCESS_TOKEN', $this->accessToken, self::FB_URL);
    }

    public function run()
    {
        return 'facebook';
    }


    /**
     * @param FacebookResponseInterface $response
     * @return bool
     */
    public function send(FacebookResponseInterface $response)
    {
        $headers = ['Content-Type: application/json'];
        $result = $this->browser->post($this->url, $headers, $response->formatJsonResponse());

        return json_decode($result->getContent());
    }
}