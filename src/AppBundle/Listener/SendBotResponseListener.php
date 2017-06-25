<?php

namespace AppBundle\Listener;

use AppBundle\Event\BotResponseEvent;
use Buzz\Browser;

/**
 * Send Bot Response
 * @package AppBundle\Listener
 */
class SendBotResponseListener
{
    /**
     * @var Browser
     */
    private $browser;

    // TODO remove direct dependency on Browser class
    // TODO make abstract layer
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @param BotResponseEvent $event
     * @return \Buzz\Message\MessageInterface
     */
    public function onBotResponse(BotResponseEvent $event)
    {
        $response = $event->getResponse();
        $requestType = $event->getRequestType();
        $headers = ['Content-Type: application/json'];
        $result = $this->browser->call($event->getUrl(), $requestType, $headers, $response->toJson());

        return $result;
    }
}
