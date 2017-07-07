<?php


namespace AppBundle\Processor;


use AppBundle\Model\BotRequest\BotRequestInterface;

interface ProcessorRequestTypeInterface
{
    /**
     * Check if Request Type machtes Provide BotRequest
     * @param BotRequestInterface $request
     * @return bool
     */
    public function isTypeMatched(BotRequestInterface $request) : bool;

    /**
     * Execute Processing on Provided Request
     * @param BotRequestInterface $request
     * @return mixed
     */
    public function execute(BotRequestInterface $request);
}