<?php

namespace AppBundle\Command\FacebookCommand;

use AppBundle\Model\BotResponse\FacebookBotResponse\GetStartedButtonDeleteResponse;
use Buzz\Message\RequestInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FacebookGetStartedButtonDeleteCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:fb:get-started-button:delete')
            ->setDescription('Delete Get Started Button')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $deleteButton = GetStartedButtonDeleteResponse::create();
        $client = $this->getContainer()->get('app.bot.client.facebook');
        $client->sendRequest($deleteButton, RequestInterface::METHOD_DELETE);
    }
}
