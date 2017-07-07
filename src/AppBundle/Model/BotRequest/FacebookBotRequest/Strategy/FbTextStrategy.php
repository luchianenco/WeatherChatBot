<?php


namespace AppBundle\Model\BotRequest\FacebookBotRequest\Strategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\BotRequestStrategyInterface;
use AppBundle\Model\BotRequest\FacebookBotRequest\TextRequest;

class FbTextStrategy implements BotRequestStrategyInterface
{

    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return bool
     */
    public function isValid(array $message) : bool
    {
        return isset($message['message']);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function getBotRequest(array $message) : BotRequestInterface
    {
        return TextRequest::createFromMessage($message);
    }
}