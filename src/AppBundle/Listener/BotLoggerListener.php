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
        $this->logger->info('########## Log Message Start #########');
        $this->logger->info('[Log] : ' . $event->getMessage());
    }

    /**
     * @param BotLogRequestEvent $event
     */
    public function onBotRequest(BotLogRequestEvent $event)
    {
        $request = $event->getRequest();

        $this->logger->info('########## Bot Log Request Start #########');
        $this->logger->info('[Log] : ' . get_class($request));
        $this->logger->info('[Log] : ' . $request->getUserId());
        $this->logger->info('[Log] : ' . $request->getPayload());
    }

    /**
     * @param BotLogResponseEvent $event
     */
    public function onBotResponse(BotLogResponseEvent $event)
    {
        $response = $event->getResponse();

        $this->logger->info('########## Bot Log Response Start #########');
        $this->logger->info('[Log] : ' . get_class($response));
        $this->logger->info('[Log] : ' . $response->toJson());
    }
}
