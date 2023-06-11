<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    public function error404(): Response
    {
        return $this->render('404');
    }
}
