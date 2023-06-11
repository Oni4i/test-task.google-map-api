<?php

namespace App;

use App\Attribute\Route;
use App\Controller\ErrorController;
use App\Service\Resources\ControllerResource;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    public function __construct(
        private readonly ControllerResource $controllerResource,
        private readonly ErrorController $errorController
    ) {
    }

    public function run(): void
    {
        $controllers = $this->controllerResource->collect();

        foreach ($controllers as $controller) {
            $reflectionClass = new \ReflectionClass($controller);

            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    /** @var Route $routeAttribute */
                    $routeAttribute = $attribute->newInstance();

                    if ($_SERVER['REQUEST_URI'] === $routeAttribute->getRoutePath()) {
                        /** @var Response $response */
                        $response = $controller->{$method->getName()}();

                        $response->send();
                    }
                }
            }
        }

        $this->errorController->error404()->send();
    }
}
