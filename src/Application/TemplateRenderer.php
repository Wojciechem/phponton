<?php

declare(strict_types=1);

namespace App\Application;

interface TemplateRenderer
{
    public function render(string $template, array $context = []): string;
}