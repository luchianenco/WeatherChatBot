<?php

namespace AppBundle\Service\BotClient;

use AppBundle\Event\BotResponseEvent;
use AppBundle\Model\BotResponse\FacebookBotResponse\BotResponseUrl;
use AppBundle\Model\BotResponse\FacebookBotResponse\FacebookResponseInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * FacebookBotClient constructor.
     * @param RequestStack $requestStack
     * @param EventDispatcherInterface $dispatcher
     * @param $accessToken
     */
    public function __construct(RequestStack $requestStack, EventDispatcherInterface $dispatcher, $accessToken)
    {
        $this->requestStack = $requestStack;
        $this->dispatcher = $dispatcher;
        $this->url = BotResponseUrl::createWithAccessToken($accessToken);
    }

    public function run()
    {
        //Get provider incoming data
        $data = json_decode(
            file_get_contents("php://input"),
            true,
            512,
            JSON_BIGINT_AS_STRING
        );


        return 'facebook';
    }

    /**
     * @param FacebookResponseInterface $response
     * @param string $requestType
     */
    public function send(FacebookResponseInterface $response, $requestType)
    {
        $event = new BotResponseEvent($response, $this->url->getUrl(), $requestType);
        $this->dispatcher->dispatch($event::NAME, $event);
    }
}