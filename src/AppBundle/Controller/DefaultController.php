<?php

namespace AppBundle\Controller;

use AppBundle\Service\BotClientService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

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
}
