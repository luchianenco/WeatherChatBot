<?php

namespace AppBundle\Service;

use AppBundle\Service\BotClient\BotClientInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RequestStack;

class BotClientService
{
    /**
     * @var BotClientInterface[]
     */
    private $clients;

    /**
     * @var RequestStack
     */
    private $requestStack;


    /**
     * RequestValidationService constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->clients = new ArrayCollection();
        $this->requestStack = $requestStack;
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
