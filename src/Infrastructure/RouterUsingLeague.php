<?php

namespace App\Infrastructure;

use App\Application\Configuration\RouteConfiguration;
use App\Application\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterUsingLeague implements Router
{
    private \League\Route\Router $router;

    /**
     * This is the only class that gets entire container.
     * Router uses service locator to retrieve appropriate request handler.
     * Do not pass entire container to your classes :)
     */
    public function __construct(ContainerInterface $container)
    {
        $this->router = new \League\Route\Router();

        $strategy = new ApplicationStrategy();
        $strategy->setContainer($container);
        $this->router->setStrategy($strategy);

        /** @var RouteConfiguration $routeConfiguration */
        $routeConfiguration = $container->get(RouteConfiguration::class);
        $routeConfiguration->apply($this->router);
    }

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}