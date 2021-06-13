<?php

declare(strict_types=1);

namespace App\UI\RequestHandler;

use App\Application\TemplateRenderer;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class LandingPage implements RequestHandlerInterface
{
    use InvokableRequestHandlerTrait;

    private TemplateRenderer $renderer;
    private LoggerInterface $logger;

    public function __construct(TemplateRenderer $renderer, LoggerInterface $logger)
    {
        $this->renderer = $renderer;
        $this->logger = $logger;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $this->renderer->render('landing.html.twig');
        $this->logger->info('Accessed landing page');
        return new Response(200, [], $body);
    }
}