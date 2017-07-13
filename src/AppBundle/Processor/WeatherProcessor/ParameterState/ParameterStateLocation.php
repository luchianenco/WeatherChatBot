<?php


namespace AppBundle\Processor\WeatherProcessor\ParameterState;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\FacebookBotResponse\ContentTextResponse;
use AppBundle\Processor\WeatherProcessor\WeatherApiService;

class ParameterStateLocation implements ParameterStateInterface
{
    const ORDER = 900000;
    const TEXT = 'Today at %s in %s was %s';

    /**
     * @var WeatherApiService
     */
    private $service;

    public function __construct(WeatherApiService $service)
    {
        $this->service = $service;
    }

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
        // TODO refactor

        $location = $request->getPayload();
        $response = $this->service->getByCityName($location);

        $date = new \DateTime();
        $date->setTimestamp($response->dt);

        $temp = round($response->main->temp) . '°C';
        $weatherDesc = $response->weather[0]->main;

        $time = $date->format('H:i');
        $city = $response->name;
        $desc = $temp . ' and ' .$weatherDesc;

        $result = sprintf(self::TEXT, $time, $city, $desc);

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