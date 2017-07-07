<?php


namespace AppBundle\Model\BotRequest;

/**
 * Bot Request Interface
 * @package AppBundle\Model\BotRequest
 */
interface BotRequestInterface
{
    /**
     * Get User Id
     * @return int
     */
    public function getUserId() : int;

    /**
     * Get Payload
     * @return string
     */
    public function getPayload() : string;
}