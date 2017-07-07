<?php


namespace AppBundle\Event;

use AppBundle\Model\BotResponse\BotResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class BotResponseEvent extends Event
{
    const NAME = 'bot.response';

    /**
     * @var BotResponseInterface
     */
    private $response;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $requestType;

    /**
     * BotResponseEvent constructor.
     * @param BotResponseInterface $botResponse
     * @param $url
     * @param $requestType
     */
    public function __construct(BotResponseInterface $botResponse, $url, $requestType)
    {
        $this->response = $botResponse;
        $this->url = $url;
        $this->requestType = $requestType;
    }
    /**
     * @return BotResponseInterface
     */
    public function getResponse() : BotResponseInterface
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->requestType;
    }
}