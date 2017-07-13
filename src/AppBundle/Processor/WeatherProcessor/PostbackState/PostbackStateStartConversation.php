<?php


namespace AppBundle\Processor\WeatherProcessor\PostbackState;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;

class PostbackStateStartConversation implements PostbackStateInterface
{
    const ORDER = 1000;
    const PAYLOAD = 'START_CONVERSATION';
    const TEXT = 'Hi, glad that you are here ;). Please tell me the location you are looking for.';

    /**
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isEqualPayload(BotRequestInterface $request)
    {
        return $request->getPayload() === self::PAYLOAD;
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
