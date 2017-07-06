<?php


namespace AppBundle\Model\BotRequest;

interface BotRequestStrategyInterface
{
    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return mixed
     */
    public function isValid(array $message);

    /**
     * @return BotRequestInterface
     */
    public function getBotRequest(array $message);
}