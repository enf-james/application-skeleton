<?php
namespace DemoApp\Frontend;

use ENF\James\Framework\Application\WebApplication;
use ENF\James\Framework\Middleware\MiddlewareDispatcher;
use ENF\James\Framework\Routing\RouteCollector;
use ENF\James\Framework\Routing\RouteRunner;


class App extends WebApplication
{
    public function setup()
    {
        $this->setupMiddleware();
    }

    public function createRouteCollector()
    {
        $routeCollector = new RouteCollector();
        $fun = require $this->container->get('project_dir') . '/config/routes.php';
        $fun($routeCollector);

        while(count($routeCollector->groups) > 0) {
            $group = array_shift($routeCollector->groups);
            $group->collectRoutes();
        }

        return $routeCollector;
    }


    public function setupMiddleware()
    {
        $routeRunner = new RouteRunner();
        $middlewareDispatcher = new MiddlewareDispatcher($routeRunner);

        $arr = require $this->container->get('project_dir') . '/config/middleware.php';

        while (count($arr) > 0) {
            $middleware = array_pop($arr);
            $middleware = $this->getContainer()->get($middleware);
            $middlewareDispatcher->addMiddleware($middleware);
        }

        $this->setMiddlewareDispatcher($middlewareDispatcher);
    }
}
