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
     * Send Response
     * @param FacebookResponseInterface[] $responses
     * @param $requestType
     * @return mixed
     */
    public function sendResponse(array $responses, $requestType);
}