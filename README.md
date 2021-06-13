PHPonton
--------
PHPonton is opinionated http microframework glued together for fun 
from several components. It does not tell you how to implement your stuff 
(see [Symfony](https://symfony.com/), [Laravel](https://laravel.com/))

It handles PSR-7 compliant requests and emits PSR-7 responses.  
Kernel supports any PSR-11 compliant DI container.

By default [PHP League container](https://container.thephpleague.com/3.x/) is used, 
together with [PHP League router](https://route.thephpleague.com/5.x/).

## General idea
Attempt to create a crude, working framework that is not tied to specific components.

## How to start
- see `src/Application/Configuration/ContainerConfiguration`
    - `<shift><shift>CoCo` in PHPStorm
- see `src/Application/Configuration/RouteConfiguration`
    - `<shift><shift>RoCo` in PHPStorm
- implement `Psr\Http\Server\RequestHandlerInterface` to add RequestHandlers
    - you can use `App\UI\InvokableRequestHandlerTrait` to make them 
      compatible with League router.
    - request handlers are autowired
    - basically everything can be autowired thanks to ReflectionContainer
        - I'm scared to check the performance of **that**