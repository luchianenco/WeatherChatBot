<?php


namespace AppBundle\Listener;

use AppBundle\Event\BotLogRequestEvent;
use AppBundle\Event\BotLogResponseEvent;
use AppBundle\Event\BotLogMessage;
use Psr\Log\LoggerInterface;

class BotLoggerListener
{
    private $logger;

    /**
     * BotLoggerListener constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param BotLogMessage $event
     */
    public function onBotMessage(BotLogMessage $event)
    {
        $this->logger->info('[Log Message] : ' . $event->getMessage());
    }

    /**
     * @param BotLogRequestEvent $event
     */
    public function onBotRequest(BotLogRequestEvent $event)
    {
        $request = $event->getRequest();

        $this->logger->info('[Log Request] : ' . get_class($request));
        $this->logger->info('[Log Request] : ' . $request->getUserId());
        $this->logger->info('[Log Request] : ' . $request->getPayload());
    }

    /**
     * @param BotLogResponseEvent $event
     */
    public function onBotResponse(BotLogResponseEvent $event)
    {
        $response = $event->getResponse();

        $this->logger->info('[Log Response] : ' . get_class($response));
        $this->logger->info('[Log Response] : ' . $response->toJson());
    }
}
