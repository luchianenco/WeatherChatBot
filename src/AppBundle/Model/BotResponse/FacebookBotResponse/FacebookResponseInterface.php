<?php


namespace AppBundle\Model\BotResponse\FacebookBotResponse;

use AppBundle\Model\BotResponse\BotResponseInterface;

interface FacebookResponseInterface extends BotResponseInterface
{
    /**
     * Get User ID
     * @return int
     */
    public function getUserId() : int;
}