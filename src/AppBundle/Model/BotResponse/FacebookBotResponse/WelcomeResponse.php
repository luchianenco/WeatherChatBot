<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;


class WelcomeResponse implements FacebookResponseInterface
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
     * @return WelcomeResponse
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
    public function formatJsonResponse()
    {
        $response = new \stdClass();
        $response->get_started = new \stdClass();
        $response->get_started->payload = $this->payload;

        return json_encode($response);
    }
}