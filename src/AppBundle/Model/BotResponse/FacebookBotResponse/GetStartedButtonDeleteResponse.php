<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;


class GetStartedButtonDeleteResponse implements FacebookResponseInterface
{

    /**
     * @var array
     */
    private $fields;

    /**
     * Private Constructor
     */
    private function __construct()
    {
        $this->fields[] = 'get_started';
    }

    /**
     * Named Constructor: Create
     * @return GetStartedButtonDeleteResponse
     */
    public static function create() : GetStartedButtonDeleteResponse
    {
        return new self();
    }

    /**
     * @return string
     */
    public function toJson() : string
    {
        $response = new \stdClass();
        $response->fields = $this->fields;

        return json_encode($response);
    }
}