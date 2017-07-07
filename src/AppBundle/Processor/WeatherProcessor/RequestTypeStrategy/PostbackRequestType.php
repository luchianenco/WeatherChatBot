<?php


namespace AppBundle\Processor\WeatherProcessor\RequestTypeStrategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\PostbackRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;
use AppBundle\Processor\ProcessorRequestTypeInterface;

class PostbackRequestType implements ProcessorRequestTypeInterface
{

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
        return ContentTextResponse::create('Hello');
    }
}