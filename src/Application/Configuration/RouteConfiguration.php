<?php

declare(strict_types=1);

namespace App\Application\Configuration;

use App\UI\RequestHandler\LandingPage;

class RouteConfiguration
{
    public function apply(\League\Route\Router $router): void
    {
        // todo: middleware for 404
        $router->map('GET', '/', LandingPage::class);
    }
}