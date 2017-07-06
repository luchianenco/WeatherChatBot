<?php


namespace AppBundle\Model\BotRequest\FacebookBotRequest\Strategy;

use AppBundle\Model\BotRequest\BotRequestStrategyInterface;
use AppBundle\Model\BotRequest\FacebookBotRequest\TextRequest;

class FbTextStrategy implements BotRequestStrategyInterface
{

    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return mixed
     */
    public function isValid(array $message)
    {
        return isset($message['message']);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function getBotRequest(array $message)
    {
        return TextRequest::createFromMessage($message);
    }
}