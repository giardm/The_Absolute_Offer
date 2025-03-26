<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


require dirname(__DIR__) . "/config/config.php";
require RACINE . "/app/controllers/router.php";

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
