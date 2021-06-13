<?php

declare(strict_types=1);

namespace App\Application\Configuration;

use App\Infrastructure\RouterUsingLeague;
use App\Application\Router;
use App\Application\TemplateRenderer;
use App\Infrastructure\ServerRequestCreator;
use App\Infrastructure\TemplateRendererUsingTwig;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator as NyholmServerRequestCreator;
use Psr\Log\LoggerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ContainerConfiguration
{
    public function apply(Container $container): void
    {
        $container->defaultToShared();

        $container->add(RouteConfiguration::class);
        $container->add(Router::class, RouterUsingLeague::class)
            ->addArgument($container)
        ;

        $container->add(Psr17Factory::class);

        $container->add(ServerRequestCreator::class, NyholmServerRequestCreator::class)
            ->addArgument(Psr17Factory::class)
            ->addArgument(Psr17Factory::class)
            ->addArgument(Psr17Factory::class)
            ->addArgument(Psr17Factory::class)
        ;

        $container->add(EmitterInterface::class, SapiEmitter::class);
        $container->add(LoggerInterface::class, Logger::class)
            ->addArgument('app')
            ->addArgument([new StreamHandler('../log/app.log')])
        ;

        $container->add(Environment::class)
            ->addArgument(new FilesystemLoader('../templates/'))
            ->addArgument(['cache' => '../cache/templates/'])
        ;

        $container->add(TemplateRenderer::class, TemplateRendererUsingTwig::class)
            ->addArgument(Environment::class)
        ;

        // Autowiring
        $container->delegate(
            (new ReflectionContainer())->cacheResolutions()
        );
    }
}