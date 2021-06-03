<?php

use ENF\James\Framework\Routing\RouteCollector;
use ENF\James\Framework\Routing\RouteGroup;

return function(RouteCollector $rc) {
    $rc->setNamePrefix('frontend.')
        ->setPathPrefix('/zh');

    $rc->get('/', 'DemoApp\Frontend\Controller\ArticleController::home')
        ->setName('home');

    $rc->get('/about', 'DemoApp\Frontend\Controller\ArticleController::about')
        ->setName('about');

    $rc->group(function(RouteGroup $group){
        $group->get('/{id}', 'DemoApp\Frontend\Controller\ArticleController::show')
            ->setName('show');
        $group->get('/{id}/edit', 'DemoApp\Frontend\Controller\ArticleController::edit')
            ->setName('edit');
    })
    ->setNamePrefix('article.')
    ->setPathPrefix('/article');
};
