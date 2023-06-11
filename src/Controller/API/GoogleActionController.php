<?php

namespace App\Controller\API;

use App\Attribute\Route;
use App\Controller\AbstractController;
use App\Service\Google\ActionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GoogleActionController extends AbstractController
{
    public function __construct(
        private readonly Request $request,
        private readonly ActionService $actionService
    )
    {
    }

    #[Route('/google/address-activity/create')]
    public function createAddress(): Response
    {
        $address = $this->request->request->get('address', null);

        if (!$address) {
            return $this->errorJson(['Something went wrong']);
        }

        $storedAddress = $this->actionService->createAddressActivity($address);

        return $this->successJson($storedAddress);
    }
}
