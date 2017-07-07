<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Event\BotLogMessage;
use AppBundle\Event\BotLogRequestEvent;
use AppBundle\Event\BotLogResponseEvent;
use AppBundle\Event\BotResponseEvent;
use AppBundle\Factory\BotRequestFactoryInterface;
use AppBundle\Factory\FacebookBotRequestFactory;
use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\BotResponseUrlInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\BotResponseUrl;
use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;
use AppBundle\Processor\ProcessorMediator;
use Buzz\Message\RequestInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Facebook Bot Client
 * @package AppBundle\Service\BotClient
 */
class FacebookBotClient implements BotClientInterface
{
    /**
     * @var BotResponseUrl
     */
    private $url;

    /**
     * @var FacebookBotRequestFactory
     */
    private $factory;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var ProcessorMediator
     */
    private $mediator;

    /**
     * FacebookBotClient constructor.
     * @param BotRequestFactoryInterface $factory
     * @param EventDispatcherInterface $dispatcher
     * @param ProcessorMediator $mediator
     */
    public function __construct(BotRequestFactoryInterface $factory, EventDispatcherInterface $dispatcher, ProcessorMediator $mediator)
    {
        $this->factory = $factory;
        $this->dispatcher = $dispatcher;
        $this->mediator = $mediator;
    }

    /**
     * @param BotResponseUrlInterface $url
     * @return array
     */
    public function run(BotResponseUrlInterface $url) : array
    {
        $this->url = $url;
        $rawRequest = $this->readRawRequest();
        $requests = $this->processRawRequestData($rawRequest);

        $responses = $this->mediator->execute($requests);
        $this->sendResponse($responses, RequestInterface::METHOD_POST);

        return ['countRequests' => count($requests), 'countResponses' => count($responses)];
    }

    /**
     * Read Raw Incoming request
     * @return array
     */
    private function readRawRequest()
    {
        //Get provider incoming data
        return json_decode(file_get_contents("php://input"), true, 512,JSON_BIGINT_AS_STRING);
    }

    /**
     * TODO Create Abstract Reader Class and Implementation
     * @param $data
     * @return BotRequestInterface[]
     */
    private function processRawRequestData($data) : array
    {
        $requests = [];

        if (!is_array($data['entry'][0]['messaging']) || empty($data['entry'][0]['messaging'])) {
            return $requests;
        }

        // Loop through received messages
        foreach ($data['entry'][0]['messaging'] as $message) {
            // Skipping delivery messages
            if (isset($message['delivery']) || isset($message['read']) || isset($message['message']['is_echo'])) {
                continue;
            }

            try {
                $request = $this->factory->createBotRequestFromMessage($message);
                $requests[] = $request;
                $event = new BotLogRequestEvent($request);
                $this->dispatcher->dispatch($event::NAME, $event);
            } catch (\LogicException $e) {
                $event = new BotLogMessage($e->getMessage());
                $this->dispatcher->dispatch($event::NAME, $event);
            }
        }

        return $requests;
    }

    /**
     * @param FacebookResponseInterface[] $responses
     * @param string $requestType
     * @return BotClientInterface
     */
    public function sendResponse(array $responses, $requestType) : BotClientInterface
    {
        foreach ($responses as $response) {
            // Dispatch Send Response Event
            $event = new BotResponseEvent($response, $this->url->getUrl(), $requestType);
            $this->dispatcher->dispatch($event::NAME, $event);

            // Log Response Event
            $logEvent = new BotLogResponseEvent($response);
            $this->dispatcher->dispatch($logEvent::NAME, $logEvent);

        }
        return $this;
    }
}