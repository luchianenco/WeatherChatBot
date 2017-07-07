<?php


namespace AppBundle\Model\BotRequest\FacebookBotRequest\Strategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\BotRequestStrategyInterface;
use AppBundle\Model\BotRequest\FacebookBotRequest\QuickReplyRequest;

class FbQuickReplyStrategy implements BotRequestStrategyInterface
{

    /**
     * Is Given array valid to create BotRequet Object
     * @param array $message
     * @return mixed
     */
    public function isValid(array $message) : bool
    {
        return isset($message['message']['quick_reply']);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function getBotRequest(array $message) : BotRequestInterface
    {
        return QuickReplyRequest::createFromMessage($message);
    }
}