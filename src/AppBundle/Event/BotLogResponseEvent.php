<?php


namespace AppBundle\Event;

use AppBundle\Model\BotResponse\BotResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class BotLogResponseEvent extends Event
{
    const NAME = 'bot.log.response';

    /**
     * @var BotResponseInterface
     */
    private $response;

    /**
     * BotResponseEvent constructor.
     * @param BotResponseInterface $botResponse
     */
    public function __construct(BotResponseInterface $botResponse)
    {
        $this->response = $botResponse;
    }

    /**
     * @return BotResponseInterface
     */
    public function getResponse() : BotResponseInterface
    {
        return $this->response;
    }
}