<?php

use ENF\James\Framework\Middleware\AuthorizationMiddleware;

// route name => middleware

return [
    'article' => AuthorizationMiddleware::class,
];