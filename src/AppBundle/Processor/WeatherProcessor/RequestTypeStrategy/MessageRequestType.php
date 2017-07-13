<?php


namespace AppBundle\Processor\WeatherProcessor\RequestTypeStrategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\MessageRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;
use AppBundle\Processor\ProcessorRequestTypeInterface;
use AppBundle\Processor\WeatherProcessor\ParameterState\ParameterStateInterface;
use AppBundle\Processor\WeatherProcessor\PostbackState\PostbackStateInterface;

class MessageRequestType implements ProcessorRequestTypeInterface
{
    const ORDER = 300;

    private $states = [];

    /**
     * @param ParameterStateInterface $state
     */
    public function addState(ParameterStateInterface $state)
    {
        $order = $state->getOrder();
        $this->states[$order] = $state;
        ksort($this->states);
    }

    /**
     * Check if Request Type machtes Provide BotRequest
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isTypeMatched(BotRequestInterface $request) : bool
    {
        return $request instanceof MessageRequestInterface;
    }

    /**
     * Execute Processing on Provided Request
     * @param BotRequestInterface $request
     * @return BotResponseInterface
     */
    public function execute(BotRequestInterface $request) : BotResponseInterface
    {
        return $this->selectStrategy($request);
    }

    /**
     * @param BotRequestInterface $request
     * @return ContentTextResponse
     */
    private function selectStrategy(BotRequestInterface $request)
    {
        /** @var PostbackStateInterface $state */
        foreach ($this->states as $state) {
            if ($state->isEqualPayload($request)) {
                return $state->createResponse($request);
            }
        }
    }

    /**
     * Get Order Number
     * @return int
     */
    public function getOrder() : int
    {
        return self::ORDER;
    }
}