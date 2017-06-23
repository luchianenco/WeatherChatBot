<?php


namespace AppBundle\Service\BotClient;

/**
 * Facebook Bot Client
 * @package AppBundle\Service\BotClient
 */
class FacebookBotClient implements BotClientInterface
{
    public function __construct()
    {
    }

    public function run()
    {
        return 'facebook';
    }
}