<?php


namespace AppBundle\Processor\WeatherProcessor\ParameterState;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

class ParameterStateLocation implements ParameterStateInterface
{
    const ORDER = 900000;
    const TEXT = 'Today in %s is %s';

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
        $location = $request->getPayload();
        $result = sprintf(self::TEXT, $location, '20°C and sunny');

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