<?php


namespace AppBundle\Factory;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\BotRequestStrategyInterface;

class FacebookBotRequestFactory implements BotRequestFactoryInterface
{
    private $strategies;

    /**
     * @param BotRequestStrategyInterface $strategy
     * @param int $order
     */
    public function addStrategy(BotRequestStrategyInterface $strategy, $order)
    {
        if (isset($this->strategies[$order])) {
            throw new \InvalidArgumentException(sprintf('A strategy with order \'%s\' is set already', $order));
        }

        $this->strategies[$order] = $strategy;
    }

    /**
     * @param array $message
     * @return BotRequestInterface
     */
    public function createBotRequestFromMessage(array $message)
    {
        /** @var BotRequestStrategyInterface $strategy */
        foreach($this->strategies as $strategy) {
            if ($strategy->isValid($message)) {
                return $strategy->getBotRequest($message);
            }
        }

        throw new \LogicException('Invalid message for Request provided');
    }
}
