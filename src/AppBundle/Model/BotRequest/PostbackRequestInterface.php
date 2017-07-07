<?php


namespace AppBundle\Model\BotRequest;


interface PostbackRequestInterface
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