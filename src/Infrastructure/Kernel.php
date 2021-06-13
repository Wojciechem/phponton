<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\Router;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parseRequest(): ServerRequestInterface
    {
        /** @var ServerRequestCreator $creator */
        $creator = $this->container->get(ServerRequestCreator::class);

        return $creator->fromGlobals();
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Router $router */
        $router = $this->container->get(Router::class);

        return $router->dispatch($request);
    }

    public function emit(ResponseInterface $response): void
    {
        /** @var EmitterInterface $emitter */
        $emitter = $this->container->get(EmitterInterface::class);

        $emitter->emit($response);
    }
}