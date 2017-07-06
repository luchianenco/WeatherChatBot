<?php

namespace AppBundle\Controller;

use AppBundle\Event\BotLogMessage;
use AppBundle\Service\BotClientService;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/client/{botClient}/webhook", name="bot_webhook")
     * @param Request $request
     * @param BotClientService $service
     * @param $botClient
     * @return Response
     */
    public function webhookAction(Request $request, BotClientService $service, $botClient)
    {
        $event = new BotLogMessage('Request income');
        $this->get('event_dispatcher')->dispatch($event::NAME, $event);

        $verifyToken = $this->getParameter('facebook_verify_token');

        if ($request->query->get('hub_verify_token') === $verifyToken) {
            $data = $request->query->get('hub_challenge');

            return new Response($data);
        }

        //Bot Client should be bot client service alias
        $data = $service->run($botClient);

        return new JsonResponse($data);
    }
}
