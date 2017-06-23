<?php


namespace AppBundle\Service\BotClient;

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
}