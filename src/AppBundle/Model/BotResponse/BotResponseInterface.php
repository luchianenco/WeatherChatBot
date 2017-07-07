<?php

namespace AppBundle\Model\BotResponse;

interface BotResponseInterface
{
    public function toJson() : string;
}