<?php


namespace AppBundle\Processor;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;

class ProcessorMediator
{
    /**
     * @var ProcessorInterface
     */
    private $processor;

    /**
     * ProcessorMediator constructor
     * @param ProcessorInterface $processor
     */
    public function __construct(ProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @param BotRequestInterface[] $requests
     * @return BotResponseInterface[]
     */
    public function execute(array $requests) : array
    {
        return $this->processor->process($requests);
    }
}