<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestCreator
{
    public function fromGlobals(): ServerRequestInterface;
}