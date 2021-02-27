<?php
require_once("vendor/autoload.php");

use Spatie\Ssr\Renderer;
use Spatie\Ssr\Engines\Node;

$engine = new Node("node", "/var/www/symfony-5-ssr/temp");

$renderer = new Renderer($engine);

echo $renderer
    ->entry(__DIR__."/js/main.js")
    ->render();
