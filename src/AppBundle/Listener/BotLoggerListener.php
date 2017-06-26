<?php


namespace AppBundle\Listener;

use AppBundle\Event\BotLogRequestEvent;
use AppBundle\Event\BotLogResponseEvent;
use Psr\Log\LoggerInterface;

class BotLoggerListener
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onBotRequest(BotLogRequestEvent $event)
    {

    }

    public function onBotResponse(BotLogResponseEvent $event)
    {
        $response = $event->getResponse();

        $this->logger->info('########## Bot Log Response Start #########');
        $this->logger->info('[Log] : ' . get_class($response));
        $this->logger->info('[Log] : ' . $response->toJson());
    }
}