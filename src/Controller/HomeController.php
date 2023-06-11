<?php

namespace App\Controller;

use App\Attribute\Route;
use App\Service\Google\ActionService;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly Environment $environment,
        private readonly ActionService $actionService
    )
    {
    }

    #[Route('/index')]
    public function index(): Response
    {
        return $this->render($this->environment->render('index.twig', [
            'GOOGLE_API_KEY' => $_ENV['GOOGLE_MAPS_KEY'],
            'historyRequests' => $this->actionService->findAllAddresses()
        ]));
    }
}