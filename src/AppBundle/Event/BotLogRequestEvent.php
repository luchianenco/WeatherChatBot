<?php


namespace AppBundle\Event;

use AppBundle\Model\BotRequest\BotRequestInterface;
use Symfony\Component\EventDispatcher\Event;

class BotLogRequestEvent extends Event
{
    const NAME = 'bot.log.request';

    /**
     * @var BotRequestInterface
     */
    private $request;

    /**
     * BotRequestEvent constructor.
     * @param BotRequestInterface $botRequest
     */
    public function __construct(BotRequestInterface $botRequest)
    {
        $this->request = $botRequest;
    }

    /**
     * @return BotRequestInterface
     */
    public function getRequest() : BotRequestInterface
    {
        return $this->request;
    }
}