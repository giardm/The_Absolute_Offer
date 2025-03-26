<?php

class Router
{
  public function dispatch($uri)
  {
    // Récupérer dynamiquement le dossier de base du projet
    $scriptName = dirname($_SERVER['SCRIPT_NAME']); // Ex: /web/The_Absolute_Offer/public
    $uri = str_replace($scriptName, '', $uri); // Supprime le chemin de base

    // S'assurer que l'URI commence toujours par un "/"
    $uri = '/' . trim($uri, '/');

    // Débogage : Voir l'URI après traitement
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
