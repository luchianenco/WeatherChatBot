<?php


namespace AppBundle\Model\BotResponse;


interface BotResponseUrlInterface
{
    /**
     * Get Url
     * @return mixed
     */
    public function getUrl() : string;
}