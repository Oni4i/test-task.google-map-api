<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected function successJson(mixed $data): Response
    {
        return $this->json([
            'error' => false,
            'data' => $data
        ]);
    }

    protected function errorJson(mixed $data, int $code = 500): Response
    {
        return $this->json([
            'error' => true,
            'data' => $data
        ]);
    }

    protected function json(mixed $data, int $code = 200): Response
    {
        return new Response(json_encode($data, JSON_THROW_ON_ERROR), $code, ['Content-Type' => 'application/json']);
    }

    protected function render(string $content): Response
    {
        return new Response($content, 200, ['Content-Type' => 'text/html']);
    }
}
