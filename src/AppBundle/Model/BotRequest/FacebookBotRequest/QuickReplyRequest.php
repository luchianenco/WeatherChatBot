<?php

namespace AppBundle\Model\BotRequest\FacebookBotRequest;

use AppBundle\Model\BotRequest\BotRequestInterface;

class QuickReplyRequest implements BotRequestInterface
{
    /**
     * Facebook Sender ID
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $payload;

    /**
     * @param $userId
     * @param $payload
     */
    private function __construct($userId, $payload)
    {
        $this->userId = (int) $userId;
        $this->payload = $payload;
    }

    /**
     * Create QuickReply from message array
     * @param array $message
     * @return QuickReplyRequest
     */
    public static function createFromMessage(array $message) : QuickReplyRequest
    {
        if ($message['sender'] && isset($message['sender']['id'])
            && isset($message['message']) && isset($message['message']['quick_reply'])
            && isset($message['message']['quick_reply']['payload'])) {

            // Create from message array
            return new self($message['sender']['id'], $message['message']['quick_reply']['payload']);
        }

        throw new \InvalidArgumentException('Invalid message array provided!');
    }


    /**
     * @return int
     */
    public function getUserId() : int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getPayload() : string
    {
        return $this->payload;
    }
}
