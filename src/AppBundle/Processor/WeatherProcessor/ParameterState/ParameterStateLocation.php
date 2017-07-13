<?php


namespace AppBundle\Processor\WeatherProcessor\ParameterState;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

class ParameterStateLocation implements ParameterStateInterface
{
    const ORDER = 900000;
    const TEXT = 'The weather for %s is %s';

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
        $result = sprintf(self::TEXT, 'Berlin', '20°C and sunny');

        return ContentTextResponse::create($request->getUserId(), $result);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return self::ORDER;
    }
}