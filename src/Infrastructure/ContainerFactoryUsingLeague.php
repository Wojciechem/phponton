<?php

namespace App\Infrastructure;

use App\Application\Configuration\ContainerConfiguration;
use App\Application\ContainerFactory;
use League\Container\Container;
use Psr\Container\ContainerInterface;

class ContainerFactoryUsingLeague implements ContainerFactory
{
    public function create(): ContainerInterface
    {
        $container = new Container();
        $configuration = new ContainerConfiguration();
        $configuration->apply($container);

        return $container;
    }
}