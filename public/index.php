<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$projectDir = dirname(__DIR__);
require $projectDir . '/vendor/autoload.php';

$app = new \DemoApp\Frontend\App();
$app->setProjectDir($projectDir);
$app->run();
