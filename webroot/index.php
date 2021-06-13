<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ApplicationContainer;
use App\Infrastructure\ContainerFactoryUsingLeague;
use App\Infrastructure\Kernel;

$kernel = new Kernel(new ApplicationContainer(new ContainerFactoryUsingLeague()));

$request = $kernel->parseRequest();
$response = $kernel->handle($request);
$kernel->emit($response);
