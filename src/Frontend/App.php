<?php
namespace DemoApp\Frontend;

use DI\ContainerBuilder;
use ENF\James\Framework\Application\WebApplication;
use ENF\James\Framework\Middleware\MiddlewareDispatcher;

class App extends WebApplication
{

    public function setupContainer()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->useAnnotations(false);
        $builder->addDefinitions($this->getProjectDir() . '/config/container.php');
        $container = $builder->build();
        $container->set(static::class, $this);
        $this->setContainer($container);
    }


    public function setupMiddleware()
    {
        $middlewareDispatcher = new MiddlewareDispatcher();
        $this->setMiddlewareDispatcher($middlewareDispatcher);

        $arr = require $this->getProjectDir() . '/config/middleware.php';

        while (count($arr) > 0) {
            $middleware = array_pop($arr);
            $middleware = $this->getContainer()->get($middleware);
            $middlewareDispatcher->addMiddleware($middleware);
        }

        var_dump($this);
        exit;

    }
}
