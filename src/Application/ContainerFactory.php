<?php

declare(strict_types=1);

namespace App\Application;

use Psr\Container\ContainerInterface;

interface ContainerFactory
{
    public function create(): ContainerInterface;
}