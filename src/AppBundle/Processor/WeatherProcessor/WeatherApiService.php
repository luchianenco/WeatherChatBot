<?php


namespace AppBundle\Processor\WeatherProcessor;

use AppBundle\Event\BotLogMessage;
use Buzz\Browser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * WeatherApiService constructor.
     * @param Browser $browser
     * @param EventDispatcherInterface $dispatcher
     * @param $appId
     */
    public function __construct(Browser $browser, EventDispatcherInterface $dispatcher, $appId)
    {
        $this->browser = $browser;
        $this->dispatcher = $dispatcher;
        $this->appId = $appId;
    }

    /**
     * @param $name
     * @return \Buzz\Message\MessageInterface
     */
    public function getByCityName($name)
    {
        $url = str_replace('__APP_ID__', $this->appId, self::URL);
        $url .= '&q=' . $name;

        $response = $this->browser->get($url)->getContent();

        $event = new BotLogMessage($url);
        $this->dispatcher->dispatch($event::NAME, $event);

        $event = new BotLogMessage($response);
        $this->dispatcher->dispatch($event::NAME, $event);

        return json_decode($response);
    }
}