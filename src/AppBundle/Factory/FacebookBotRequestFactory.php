<?php


namespace AppBundle\Factory;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotRequest\BotRequestStrategyInterface;

class FacebookBotRequestFactory implements BotRequestFactoryInterface
{
    private $strategies = [];

    /**
     * @param BotRequestStrategyInterface $strategy
     * @param int $order
     * @return FacebookBotRequestFactory
     */
    public function addStrategy(BotRequestStrategyInterface $strategy, $order)
    {
        if (isset($this->strategies[$order])) {
            throw new \InvalidArgumentException(sprintf('A strategy with order \'%s\' is set already', $order));
        }

        $this->strategies[$order] = $strategy;
        ksort($this->strategies);

        return $this;
    }

    /**
     * @param array $message
     * @return BotRequestInterface
     */
    public function createBotRequestFromMessage(array $message)
    {
        if (!count($this->strategies)) {
            throw new \LogicException('There is no any Bot Request Strategy Defined');
        }

        /** @var BotRequestStrategyInterface $strategy */
        foreach($this->strategies as $strategy) {
            if ($strategy->isValid($message)) {
                return $strategy->getBotRequest($message);
            }
        }

        throw new \LogicException('Invalid message for Request provided');
    }
}
