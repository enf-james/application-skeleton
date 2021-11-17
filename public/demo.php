<?php
$html = file_get_contents(__DIR__. '/demo.html');

$r = preg_replace_callback('|src="(?!https?://)([^"]+)"|', function($matches){
    $url = "https://" . ltrim($matches[1], '/');
    return "src=\"$url\"";
}, $html);
var_dump($r);
