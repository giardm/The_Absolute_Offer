<?php
require_once MODELS_PATH . '/userModel.php';

// Nouvelle table de routage avec chemins mis à jour
$routes = [
    'home'             => 'home/homeController.php',
    'search'           => 'products/searchController.php',
    'profil'           => 'users/profilController.php',
    'product'          => 'products/productController.php',
    'addFeaturedOffer' => 'home/featuredOffersController.php',
    'login'            => 'users/loginController.php',
    'logout'           => function() {
        logout();
        require_once CONTROLLERS_PATH . '/home/homeController.php';
    },
    'register'         => 'users/registerController.php',
    'steamInfo'        => 'proxy/steamController.php',
];

// Action demandée
$action = $_GET['action'] ?? 'home';

if (isset($routes[$action])) {
    $route = $routes[$action];

    if (is_callable($route)) {
        $route(); // exécute logout() + redirection
    } else {
        require_once CONTROLLERS_PATH . '/' . $route;
    }
} else {
    require_once CONTROLLERS_PATH . '/core/errorController.php';
}
