<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;

/**
 * Content Text Message
 * @package AppBundle\Model\BotResponse\FacebookBotResponse
 */
class ContentTextResponse implements FacebookResponseInterface
{
    private $text;

    /**
     * WelcomeResponse constructor.
     * @param string $text
     */
    private function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * @param string $text
     * @return ContentTextResponse
     */
    public static function create($text)
    {
        return new self($text);
    }

    /**
     * @return string
     */
    public function toJson() : string
    {
        $response = new \stdClass();
        $response->message = new \stdClass();
        $response->message->text = $this->text;

        return json_encode($response);
    }
}