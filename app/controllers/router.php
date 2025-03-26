<?php

class Router
{
  private $routes = [];

  // Ajouter une route
  public function addRoute($url, $controller, $action)
  {
    $this->routes[$url] = ['controller' => $controller, 'action' => $action];
  }

  // Analyser l'URL de la requête et appeler le contrôleur/action appropriés
  public function dispatch()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : 'home'; // Par défaut, on va vers 'home'

    if (isset($this->routes[$url])) {
      $controllerName = $this->routes[$url]['controller'];
      var_dump($controllerName);
      $action = $this->routes[$url]['action'];

      // Inclure le contrôleur
      require_once RACINE . "/app/controllers/$controllerName.php";

      // Créer une instance du contrôleur
      $controller = new $controllerName();

      // Appeler l'action
      $controller->$action();
    } else {
      // Gérer une route non trouvée
      echo "404 - Page non trouvée";
    }
  }
}


//$router->addRoute('about', 'about_ctlr', 'index');
