<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;


use AppBundle\Model\BotResponse\BotResponseInterface;

class GetStartedButtonCreateResponse implements BotResponseInterface
{
    /**
     * @var string
     */
    private $payload;

    /**
     * WelcomeResponse constructor.
     * @param $payload
     */
    private function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param $payload
     * @return GetStartedButtonCreateResponse
     */
    public static function create($payload)
    {
        return new self($payload);
    }

    /**
     * @return string
     */
    public function getPayload() : string
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function toJson() : string
    {
        $response = new \stdClass();
        $response->get_started = new \stdClass();
        $response->get_started->payload = $this->payload;

        return json_encode($response);
    }
}