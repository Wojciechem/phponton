<?php

declare(strict_types=1);

namespace App\Application;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ApplicationContainer implements ContainerInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerFactory $containerFactory)
    {
        $this->container = $containerFactory->create();
    }

    /**
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     * @return mixed
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }
}