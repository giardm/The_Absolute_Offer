<?php

class Router
{
  public function dispatch($uri)
  {
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $uri = str_replace($scriptName, '', $uri);

    $uri = '/' . trim($uri, '/');

    var_dump($uri);

    // Vérification des routes
    if ($uri == '/' || $uri == '/home') {
      require_once '../app/controllers/homeController.php';
      $controller = new HomeController();
      $controller->index();
    } else {
      require_once '../app/controllers/errorController.php';
      $controller = new ErrorController();
      $controller->index();
    }
  }
}
