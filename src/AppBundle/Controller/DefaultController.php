<?php

namespace AppBundle\Controller;

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
     * @Route("/client/{botClient}", name="bot_client")
     * @param BotClientService $service
     * @param $botClient
     * @return JsonResponse
     */
    public function botAction(BotClientService $service, $botClient)
    {
        //Bot Client should be bot client service alias
        $data = $service->run($botClient);

        return new JsonResponse($data);
    }

    /**
     * @Route("/client/facebook/webhook", name="facebook_webhook")
     * @param Request $request
     * @return Response
     */
    public function webhookAction(Request $request)
    {
        $data = 'Error, wrong validation token';
        $verifyToken = $this->getParameter('facebook_verify_token');

        if ($request->query->get('hub_verify_token') === $verifyToken) {
            $data = $request->query->get('hub_challenge');
        }

        return new Response($data);
    }
}
