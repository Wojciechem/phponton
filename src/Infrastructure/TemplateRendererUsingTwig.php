<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\Exception\TemplateRenderingError;
use App\Application\TemplateRenderer;
use Twig\Environment;
use Twig\Error\Error;

class TemplateRendererUsingTwig implements TemplateRenderer
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(string $template, array $context = []): string
    {
        try {
            return $this->twig->render($template, $context);
        } catch (Error $e) {
            throw new TemplateRenderingError($e->getMessage(), 0, $e);
        }
    }
}