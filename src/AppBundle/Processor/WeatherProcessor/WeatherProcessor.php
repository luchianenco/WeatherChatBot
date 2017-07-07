<?php


namespace AppBundle\Processor\WeatherProcessor;

use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;
use AppBundle\Processor\ProcessorInterface;
use AppBundle\Processor\ProcessorRequestTypeInterface;

class WeatherProcessor implements ProcessorInterface
{
    /**
     * @var ProcessorRequestTypeInterface[]
     */
    private $requestTypes = [];

    /**
     * @param ProcessorRequestTypeInterface $type
     * @return WeatherProcessor
     */
    public function addRequestType(ProcessorRequestTypeInterface $type) : WeatherProcessor
    {
        $key = get_class($type);

        if (isset($this->requestTypes[$key])) {
            throw new \LogicException(sprintf('The Request Type \'%s\'is already defined in the collection', $key));
        }

        $this->requestTypes[$key] = $type;

        return $this;
    }

    /**
     * Process Incoming Requests in the Request Type defined by Request Type
     * @param BotRequestInterface[] $requests
     * @return BotResponseInterface[]
     */
    public function process(array $requests) : array
    {
        $responses = [];
        foreach($requests as $request) {
            $responses[] = $this->executeMatchStrategy($request);
        }

        return $responses;
    }

    /**
     * Select Processing Strategy over provided Request
     * @param BotRequestInterface $request
     * @return BotResponseInterface
     */
    private function executeMatchStrategy(BotRequestInterface $request) : BotResponseInterface
    {
        foreach ($this->requestTypes as $requestType) {
            if ($requestType->isTypeMatched($request)) {
                return $requestType->execute($request);
            }
        }
    }
}
