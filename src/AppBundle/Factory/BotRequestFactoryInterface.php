<?php


namespace AppBundle\Factory;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\BotRequestStrategyInterface;

interface BotRequestFactoryInterface
{
    /**
     * @param BotRequestStrategyInterface $strategy
     * @param $order
     * @return mixed
     */
    public function addStrategy(BotRequestStrategyInterface $strategy, $order) : BotRequestFactoryInterface;

    /**
     * @param array $message
     * @return mixed
     */
    public function createBotRequestFromMessage(array $message) : BotRequestInterface;
}