<?php


namespace AppBundle\Processor\WeatherProcessor\RequestTypeStrategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\PostbackRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;
use AppBundle\Processor\ProcessorRequestTypeInterface;
use AppBundle\Processor\WeatherProcessor\PostbackState\PostbackStateInterface;

class PostbackRequestType implements ProcessorRequestTypeInterface
{
    const ORDER = 100;

    private $states = [];

    /**
     * @param PostbackStateInterface $state
     */
    public function addState(PostbackStateInterface $state)
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
        return $request instanceof PostbackRequestInterface;
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