<?php

namespace AppBundle\Model\BotRequest\FacebookBotRequest;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\MessageRequestInterface;

class TextRequest implements BotRequestInterface, MessageRequestInterface
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
     * Create Text from Message
     * @param array $message
     * @return TextRequest
     */
    public static function createFromMessage(array $message) : TextRequest
    {
        if ($message['sender'] && isset($message['sender']['id'])
            && isset($message['message']) && isset($message['message']['text'])) {

            // Create from message array
            return new self($message['sender']['id'], $message['message']['text']);
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
