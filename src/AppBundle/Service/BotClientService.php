<?php

namespace AppBundle\Service;

use AppBundle\Service\BotClient\BotClientInterface;
use Doctrine\Common\Collections\ArrayCollection;

class BotClientService
{
    /**
     * @var BotClientInterface[]
     */
    private $clients;

    /**
     * RequestValidationService constructor.
     */
    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    /**
     * @param $alias
     * @return bool
     */
    public function run($alias)
    {
        if (isset($this->clients[$alias])) {
            /** @var BotClientInterface $client */
            $client = $this->clients[$alias];
            $data = $client->run();
            
            return $data;
        }
        
        return false;
    }

    public function getBotClient($alias)
    {
        if (!$this->clients->containsKey($alias)) {
            throw new \LogicException('There is no such alis in BotClient List');
        }

        return $this->clients->get($alias);
    }

    /**
     * Add new Bot Client
     * @param BotClientInterface $client
     * @param $alias
     */
    public function addBotClient(BotClientInterface $client, $alias)
    {
        if ($this->clients->containsKey($alias)) {
            throw new \LogicException('Alias defined in BotClient List already');
        }

        if ($this->clients->contains($client)) {
            throw new \LogicException('Client is added in BotClient List already');
        }


        $this->clients[$alias] = $client;
    }
}
