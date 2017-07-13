<?php


namespace AppBundle\Processor\WeatherProcessor\ParameterState;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

interface ParameterStateInterface
{
    /**
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isEqualPayload(BotRequestInterface $request);

    /**
     * @param BotRequestInterface $request
     * @return ContentTextResponse
     */
    public function createResponse(BotRequestInterface $request);

    /**
     * @return int
     */
    public function getOrder();
}