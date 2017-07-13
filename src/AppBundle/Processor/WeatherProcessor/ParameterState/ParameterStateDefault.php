<?php


namespace AppBundle\Processor\WeatherProcessor\ParameterState;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

class ParameterStateDefault implements ParameterStateInterface
{
    const ORDER = 900000;
    const TEXT = 'Sorry but I don\'t understand :(';

    /**
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isEqualPayload(BotRequestInterface $request)
    {
        return true;
    }

    /**
     * @param BotRequestInterface $request
     * @return ContentTextResponse
     */
    public function createResponse(BotRequestInterface $request)
    {
        return ContentTextResponse::create($request->getUserId(), self::TEXT);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return self::ORDER;
    }
}