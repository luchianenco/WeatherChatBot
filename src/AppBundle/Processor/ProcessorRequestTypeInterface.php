<?php


namespace AppBundle\Processor;


use AppBundle\Model\BotRequest\BotRequestInterface;
use AppBundle\Model\BotResponse\BotResponseInterface;

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
     * @return BotResponseInterface
     */
    public function execute(BotRequestInterface $request) : BotResponseInterface;

    /**
     * Get Order Number
     * @return int
     */
    public function getOrder() : int;
}