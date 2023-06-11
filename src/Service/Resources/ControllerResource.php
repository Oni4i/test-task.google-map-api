<?php

namespace App\Service\Resources;

class ControllerResource extends AbstractResource
{
    private const CONTROLLER_KEY = 'Controller';

    protected function getPathToDirectory(): string
    {
        return __DIR__ . '/../../Controller';
    }

    protected function filter(array $classes): array
    {
        return array_filter($classes, function (string $className) {
            return strlen($className) > strlen(self::CONTROLLER_KEY)
                && !strpos($className, 'Abstract' . self::CONTROLLER_KEY)
                && strpos($className, self::CONTROLLER_KEY, -strlen(self::CONTROLLER_KEY));
        });
    }
}
