<?php


namespace AppBundle\Model\BotRequest\FacebookBotRequest\Strategy;

use AppBundle\Model\BotRequest\BotRequestStrategyInterface;
use AppBundle\Model\BotRequest\FacebookBotRequest\QuickReplyRequest;

class FbQuickReplyStrategy implements BotRequestStrategyInterface
{

    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return mixed
     */
    public function isValid(array $message)
    {
        return isset($message['message']['quick_reply']);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function getBotRequest(array $message)
    {
        return QuickReplyRequest::createFromMessage($message);
    }
}