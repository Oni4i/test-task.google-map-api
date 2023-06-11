<?php

namespace App\Attribute;

use Attribute;

#[Attribute]
class Route
{
    public function __construct(private readonly string $routePath)
    {
    }

    public function getRoutePath(): string
    {
        return $this->routePath;
    }
}
