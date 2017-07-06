<?php


namespace AppBundle\Model\BotRequest\FacebookBotRequest\Strategy;

use AppBundle\Model\BotRequest\BotRequestStrategyInterface;
use AppBundle\Model\BotRequest\FacebookBotRequest\PostbackRequest;

class FbPostBackStrategy implements BotRequestStrategyInterface
{

    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return mixed
     */
    public function isValid(array $message)
    {
        return isset($message['postback']);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function getBotRequest(array $message)
    {
        return PostbackRequest::createFromMessage($message);
    }
}