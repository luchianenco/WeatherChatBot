<?php

namespace AppBundle\Controller;

use AppBundle\Event\BotLogMessage;
use AppBundle\Model\BotResponse\FacebookBotResponse\BotResponseUrl;
use AppBundle\Service\BotClientService;
use Buzz\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/client/{alias}/webhook", name="bot_webhook")
     * @param Request $request
     * @param BotClientService $service
     * @param $alias
     * @return Response
     */
    public function webhookAction(Request $request, BotClientService $service, $alias)
    {
        $event = new BotLogMessage('Request income');
        $this->get('event_dispatcher')->dispatch($event::NAME, $event);


        $verifyToken = $this->getParameter('facebook_verify_token');

        // Check for webhook init
        if ($request->query->get('hub_verify_token') === $verifyToken) {
            $data = $request->query->get('hub_challenge');

            return new Response($data);
        }

        //Bot Client should be bot client service alias
        $responseUrl = BotResponseUrl::createMessageUrl($this->getParameter('facebook_access_token'));
        $botClient = $service->getBotClient($alias);
        $responses = $botClient->run($responseUrl);
        $botClient->sendResponse($responses, RequestInterface::METHOD_POST);

        $event = new BotLogMessage('Request finish ');
        $this->get('event_dispatcher')->dispatch($event::NAME, $event);

        return new JsonResponse([]);
    }
}
