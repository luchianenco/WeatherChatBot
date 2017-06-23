<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\BotClient\FacebookBotClient;
use AppBundle\Service\BotClientService;
use PHPUnit\Framework\TestCase;

class BotClientServiceTest extends TestCase
{

    public function testItCanAddBotClient()
    {
        $alias= 'fb';
        $client = new FacebookBotClient();
        $service = new BotClientService();

        $service->addBotClient($client, $alias);

        $this->assertEquals($client, $service->getBotClient($alias));
    }
}
