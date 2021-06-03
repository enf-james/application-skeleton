<?php
namespace DemoApp\Frontend\Controller;

use Nyholm\Psr7\Response;

class ArticleController
{
    public function home()
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
}
