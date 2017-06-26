<?php


namespace AppBundle\Factory;

use AppBundle\Model\BotRequest\FacebookBotRequest\PostbackRequest;
use AppBundle\Model\BotRequest\FacebookBotRequest\QuickReplyRequest;
use AppBundle\Model\BotRequest\FacebookBotRequest\TextRequest;

class FacebookBotRequestFactory
{
    public static function createBotRequestFromMessage(array $message)
    {
        if (isset($message['postback'])) {
            $request = PostbackRequest::createFromMessage($message);
        } elseif (isset($message['message']['quick_reply'])) {
            $request = QuickReplyRequest::createFromMessage($message);
        } elseif (isset($message['message'])) {
            $request = TextRequest::createFromMessage($message);
        } else {
            throw new \LogicException('Invalid message for Request provided');
        }

        return $request;
    }
}
