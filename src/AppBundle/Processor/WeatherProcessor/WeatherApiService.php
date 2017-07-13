<?php


namespace AppBundle\Processor\WeatherProcessor;

use Buzz\Browser;

class WeatherApiService
{
    const URL = 'http://api.openweathermap.org/data/2.5/weather?units=metric&appid=__APP_ID__';

    /** @var  string $appId */
    private $appId;

    /**
     * @var Browser
     */
    private $browser;

    /**
     * WeatherApiService constructor.
     * @param Browser $browser
     * @param $appId
     */
    public function __construct(Browser $browser, $appId)
    {
        $this->browser = $browser;
        $this->appId = $appId;
    }

    /**
     * @param $name
     * @return \Buzz\Message\MessageInterface
     */
    public function getByCityName($name)
    {
        $url = str_replace('__APP__ID__', $this->appId, self::URL);
        $url .= 'q=' . $name;

        $response = $this->browser->get($url);

        return json_decode($response);
    }
}