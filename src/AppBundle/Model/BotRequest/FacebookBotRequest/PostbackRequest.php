<?php

namespace AppBundle\Model\BotRequest\FacebookBotRequest;

use AppBundle\Model\BotRequest\BotRequestInterface;

class PostbackRequest implements BotRequestInterface
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
     * @param string $payload
     */
    private function __construct($userId, $payload)
    {
        $this->userId = (int) $userId;
        $this->payload = $payload;
    }

    /**
     * @param $userId
     * @param $payload
     * @return PostbackRequest
     */
    public static function create($userId, $payload) : PostbackRequest
    {
        return new self($userId, $payload);
    }

    /**
     * Create PostBack from message array
     * @param array $message
     * @return PostbackRequest
     * @throws \InvalidArgumentException
     */
    public static function createFromMessage(array $message) : PostbackRequest
    {
        if ($message['sender'] && isset($message['sender']['id'])
            && isset($message['postback']) && isset($message['postback']['payload'])) {

            // Create from message array
            return new self($message['sender']['id'], $message['postback']['payload']);
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