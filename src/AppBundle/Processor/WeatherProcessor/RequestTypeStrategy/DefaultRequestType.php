<?php


namespace AppBundle\Processor\WeatherProcessor\RequestTypeStrategy;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\PostbackRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;
use AppBundle\Processor\ProcessorRequestTypeInterface;

class DefaultRequestType implements ProcessorRequestTypeInterface
{

    const ORDER = 90000;

    /**
     * Check if Request Type machtes Provide BotRequest
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isTypeMatched(BotRequestInterface $request) : bool
    {
        return true;
    }

    /**
     * Execute Processing on Provided Request
     * @param BotRequestInterface $request
     * @return BotResponseInterface
     */
    public function execute(BotRequestInterface $request) : BotResponseInterface
    {
        return ContentTextResponse::create($request->getUserId(),'Default Strategy');
    }

    /**
     * Get Order Number
     * @return int
     */
    public function getOrder(): int
    {
        return self::ORDER;
    }
}