<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$projectDir = dirname(__DIR__);
require $projectDir . '/vendor/autoload.php';

$container = require $projectDir . '/config/container.php';
$app = new \DemoApp\Frontend\App();
$app->setContainer($container);
$app->run();
