<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*
require __DIR__ . '/../vendor/autoload.php';

\ENF\James\Framework\Application\WebApplication::getInstance()->run();
*/


$html = file_get_contents(__DIR__. '/demo.html');

$r = preg_replace_callback('|src="(?!https?://)([^"]+)"|', function($matches){
    $url = "https://" . trim($matches[1], '/');
    return "src=\"$url\"";
}, $html);
var_dump($r);