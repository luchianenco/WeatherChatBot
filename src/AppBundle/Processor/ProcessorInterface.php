<?php


namespace AppBundle\Processor;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;

interface ProcessorInterface
{
    /**
     * @param BotRequestInterface[] $requests
     * @return BotResponseInterface[]
     */
    public function process(array $requests) : array;
}