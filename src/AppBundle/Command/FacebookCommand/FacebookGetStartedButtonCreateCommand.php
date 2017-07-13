<?php

namespace AppBundle\Command\FacebookCommand;

use AppBundle\Model\BotResponse\FacebookBotResponse\BotResponseUrl;
use AppBundle\Model\BotResponse\FacebookBotResponse\GetStartedButtonCreateResponse;
use Buzz\Message\RequestInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class FacebookGetStartedButtonCreateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:fb:get-started-button:create')
            ->setDescription('Set Get Started Button')
            ->addArgument('payload', InputArgument::OPTIONAL, 'Payload on Button click')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $payload = $input->getArgument('payload');

        if (!$payload) {
            $payload = $this->askForPayload($input, $output);
        }

        $buttons[] = GetStartedButtonCreateResponse::create($payload);
        $responseUrl = BotResponseUrl::createProfileUrl($this->getContainer()->getParameter('facebook_access_token'));
        $client = $this->getContainer()->get('app.bot.client.facebook');
        $client
            ->setUrl($responseUrl)
            ->sendResponse($buttons, RequestInterface::METHOD_POST)
        ;
    }

    /**
     * Ask for Payload if not set
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    private function askForPayload(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Please enter the payload: ');
        $question->setValidator(function ($answer) {
            if (!$answer) {
                throw new \RuntimeException('Payload cannot be empty');
            }

            return $answer;
        });
        $question->setMaxAttempts(2);

        return  $helper->ask($input, $output, $question);
    }
}
