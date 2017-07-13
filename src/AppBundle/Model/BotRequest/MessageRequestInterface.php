<?php


namespace AppBundle\Model\BotRequest;


interface MessageRequestInterface
{
    /**
     * User Id
     * @return int
     */
    public function getUserId() : int;

    /**
     * Payload Data
     * @return string
     */
    public function getPayload() : string;
}