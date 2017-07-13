<?php


namespace AppBundle\Processor\WeatherProcessor\PostbackState;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

class PostbackStateDefault implements PostbackStateInterface
{
    const ORDER = 900000;
    const TEXT = 'Sorry but I don\'t understand this payload ;)';

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