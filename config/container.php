<?php

use DI\ContainerBuilder;
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;
use function ENF\James\Framework\app;

$projectDir = dirname(__DIR__);

$definitions = [
    'project_dir' => dirname(__DIR__),

    \DemoApp\Frontend\App::class => factory(function(){return app();}),
    \ENF\James\Framework\Routing\RouteCollectorInterface::class => factory([\DemoApp\Frontend\App::class, 'createRouteCollector']),
    \ENF\James\Framework\Routing\RouteMatcherInterface::class => autowire(\ENF\James\Framework\Routing\RouteMatcher::class),

    \Psr\Log\LoggerInterface::class => autowire(\Monolog\Logger::class)->constructor('App Log')->method('pushHandler', create(\Monolog\Handler\StreamHandler::class)->constructor($projectDir.'/var/logs/app.log')),
    \Psr\Http\Message\ServerRequestFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\RequestFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\ResponseFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\UriFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\StreamFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\UploadedFileFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \SessionHandlerInterface::class => get(SessionHandler::class),
    //\ENF\James\Framework\Routing\RouteMatcherInterface::class,
    //\ENF\James\Framework\Routing\RouteCollectorInterface::class => ''
];

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->addDefinitions($definitions);
$container = $builder->build();

return $container;
