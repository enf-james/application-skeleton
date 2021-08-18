<?php

return [
    ['method' => 'get', 'path' => '/', 'name' => 'home', 'handler'=>'DemoApp\Frontend\Controller\ArticleController::home'],
    ['method' => 'get', 'path' => '/about', 'name' => 'about', 'handler'=>'DemoApp\Frontend\Controller\ArticleController::about'],
    ['method' => 'get', 'path' => '/article/{id}', 'name' => 'article', 'handler'=>'DemoApp\Frontend\Controller\ArticleController::show'],
];
