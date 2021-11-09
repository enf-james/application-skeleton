<?php
namespace DemoApp\Frontend\Controller;

use ENF\James\Framework\Routing\Router;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class ArticleController
{
    public static function home()
    {
        $response = new Response();
        $response->getBody()->write('Welcome to homepage!');
        return $response;
    }

    public function about()
    {
        $response = new Response();
        $response->getBody()->write('About Us');
        return $response;
    }

    public function show(ServerRequestInterface $request,  $id, Router $r)
    {
        $response = new Response();
        $response->getBody()->write("Article $id");
        return $response;
    }
}
