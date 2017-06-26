<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;

/**
 * Interface for Bot Clients e.g. Facebook, Telegram, Viber, etc
 * @package AppBundle\Service\BotClient
 */
interface BotClientInterface
{
    /**
     * Runs the Bot Client
     * @return mixed
     */
    public function run();

    public function readRequest();

    public function sendResponse(FacebookResponseInterface $response, $requestType);
}