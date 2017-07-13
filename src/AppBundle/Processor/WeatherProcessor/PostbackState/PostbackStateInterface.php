<?php


namespace AppBundle\Processor\WeatherProcessor\PostbackState;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

interface PostbackStateInterface
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