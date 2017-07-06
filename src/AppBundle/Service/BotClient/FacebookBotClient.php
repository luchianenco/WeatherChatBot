<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Event\BotLogRequestEvent;
use AppBundle\Event\BotLogResponseEvent;
use AppBundle\Event\BotResponseEvent;
use AppBundle\Factory\BotRequestFactoryInterface;
use AppBundle\Factory\FacebookBotRequestFactory;
use AppBundle\Model\BotResponse\FacebookBotResponse\BotResponseUrl;
use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;
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
     * FacebookBotClient constructor.
     * @param BotRequestFactoryInterface $factory
     * @param EventDispatcherInterface $dispatcher
     * @param $accessToken
     */
    public function __construct(BotRequestFactoryInterface $factory, EventDispatcherInterface $dispatcher, $accessToken)
    {
        $this->factory = $factory;
        $this->url = BotResponseUrl::createWithAccessToken($accessToken);
    }

    /**
     * @return array
     */
    public function run()
    {
        $requests = $this->readRequest();

        // TODO Processor of Incomming Requests

        // Faked Data Returned
        return $requests;
    }

    /**
     * @return array
     */
    public function readRequest() : array
    {
        //Get provider incoming data
        $data = json_decode(
            file_get_contents("php://input"),
            true,
            512,
            JSON_BIGINT_AS_STRING
        );

        return $this->processRequestData($data);
    }

    /**
     * TODO Create Abstract Reader Class and Implementation
     * @param $data
     * @return array
     */
    private function processRequestData($data) : array
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
                $this->dispatcher->dispatch(BotLogRequestEvent::NAME, $event);
            } catch (\LogicException $e) {
                continue;
            }
        }

        return $requests;
    }

    /**
     * @param FacebookResponseInterface $response
     * @param string $requestType
     */
    public function sendResponse(FacebookResponseInterface $response, $requestType)
    {
        // Dispatch Send Response Event
        $event = new BotResponseEvent($response, $this->url->getUrl(), $requestType);
        $this->dispatcher->dispatch($event::NAME, $event);

        // Log Response Event
        $logEvent = new BotLogResponseEvent($response);
        $this->dispatcher->dispatch($logEvent::NAME, $logEvent);
    }
}