<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Model\BotResponse\BotResponseUrlInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;

/**
 * Interface for Bot Clients e.g. Facebook, Telegram, Viber, etc
 * @package AppBundle\Service\BotClient
 */
interface BotClientInterface
{
    /**
     * Runs the Bot Client
     * @param BotResponseUrlInterface $url
     * @return mixed
     */
    public function run(BotResponseUrlInterface $url);

    /**
     * Read Incoming Request
     * @return mixed
     */
    public function readRequest();

    /**
     * Send Response
     * @param FacebookResponseInterface $response
     * @param $requestType
     * @return mixed
     */
    public function sendResponse(FacebookResponseInterface $response, $requestType);
}