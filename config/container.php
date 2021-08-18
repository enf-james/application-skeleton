<?php
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;


return [
    \ENF\James\Framework\Application\WebApplication::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getInstance']),
    \ENF\James\Framework\Routing\Router::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getRouter']),
    \ENF\James\Framework\Routing\Route::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getMatchedRoute']),
    \ENF\James\Framework\Container\Invoker::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getInvoker']),
    \Psr\Container\ContainerInterface::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getContainer']),
    \Psr\Http\Message\ServerRequestInterface::class => factory([\ENF\James\Framework\Application\WebApplication::class, 'getRequest']),

    

    // \Psr\Log\LoggerInterface::class => autowire(\Monolog\Logger::class)->constructor('App Log')->method('pushHandler', create(\Monolog\Handler\StreamHandler::class)->constructor($projectDir.'/var/logs/app.log')),
    \Psr\Http\Message\ServerRequestFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\RequestFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\ResponseFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\UriFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\StreamFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \Psr\Http\Message\UploadedFileFactoryInterface::class => get(\Nyholm\Psr7\Factory\Psr17Factory::class),
    \SessionHandlerInterface::class => get(SessionHandler::class),
];
