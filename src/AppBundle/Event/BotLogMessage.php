<?php


namespace AppBundle\Event;

use AppBundle\Model\BotRequest\BotRequestInterface;
use Symfony\Component\EventDispatcher\Event;

class BotLogMessage extends Event
{
    const NAME = 'bot.log.message';

    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
}