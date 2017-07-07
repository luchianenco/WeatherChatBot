<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;

/**
 * Content Text Message
 * @package AppBundle\Model\BotResponse\FacebookBotResponse
 */
class ContentTextResponse implements FacebookResponseInterface
{
    /** @var  int */
    private $userId;

    /** @var string  */
    private $text;

    /**
     * WelcomeResponse constructor.
     * @param int $userId
     * @param string $text
     */
    private function __construct($userId, $text)
    {
        $this->userId = $userId;
        $this->text = $text;
    }

    /**
     * @param int $userId
     * @param string $text
     * @return ContentTextResponse
     */
    public static function create($userId, $text)
    {
        return new self($userId, $text);
    }

    /**
     * Get User ID
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function toJson() : string
    {
        $response = new \stdClass();
        // Set Recipient Data
        $response->recipient = new \stdClass();
        $response->recipient->id = $this->userId;

        // Set Message Data
        $response->message = new \stdClass();
        $response->message->text = $this->text;

        return json_encode($response);
    }
}