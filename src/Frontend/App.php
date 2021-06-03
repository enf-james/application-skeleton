<?php
namespace DemoApp\Frontend;

use DI\ContainerBuilder;
use ENF\James\Framework\Application\WebApplication;
use ENF\James\Framework\Middleware\MiddlewareDispatcher;
use ENF\James\Framework\Routing\RouteCollector;
use ENF\James\Framework\Routing\Router;
use ENF\James\Framework\Routing\RouteRunner;

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


    public function setupRouter()
    {
        $routeCollector = new RouteCollector();
        $router = new Router();
        $router->setRouteCollector($routeCollector);

        $fun = require $this->getProjectDir() . '/config/routes.php';
        $fun($routeCollector);

        while(count($routeCollector->groups) > 0) {
            $group = array_shift($routeCollector->groups);
            $group->collectRoutes();
        }

dump(__METHOD__);
dd($routeCollector);
    }


    public function setupMiddleware()
    {
        $routeRunner = new RouteRunner();
        $middlewareDispatcher = new MiddlewareDispatcher($routeRunner);

        $arr = require $this->getProjectDir() . '/config/middleware.php';

        while (count($arr) > 0) {
            $middleware = array_pop($arr);
            $middleware = $this->getContainer()->get($middleware);
            $middlewareDispatcher->addMiddleware($middleware);
        }
    }
}
