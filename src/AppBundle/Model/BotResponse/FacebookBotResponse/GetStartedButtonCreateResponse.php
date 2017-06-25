<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;


class GetStartedButtonCreateResponse implements FacebookResponseInterface
{
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
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        $response = new \stdClass();
        $response->get_started = new \stdClass();
        $response->get_started->payload = $this->payload;

        return json_encode($response);
    }
}