<?php
require_once MODELS_PATH . '/userModel.php';

// Table de routage
$routes = [
  'home'             => 'home/homeController.php',
  'search'           => 'products/searchController.php',
  'news'             => 'news/newsController.php',
  'addArticle'       => 'news/addArticleController.php',
  'profil'           => 'users/profilController.php',
  'deleteProfil'     => 'users/deleteProfilController.php',
  'product'          => 'products/productController.php',
  'addFeaturedOffer' => 'home/featuredOffersController.php',
  'favorite'         => 'users/favoriteController.php',
  'login'            => 'users/loginController.php',
  'logout'           => 'users/logoutController.php',
  'register'         => 'users/registerController.php',
  'steamInfo'        => 'proxy/steamController.php',
];

$pageTitles = [
  'home'       => 'Accueil',
  'search'     => 'Recherche',
  'news'       => 'News',
  'addArticle' => 'Ajouter un article',
  'profil'     => 'Profil',
  'product'    => '',
  'login'      => 'Connexion',
  'register'   => 'Inscription',
];


// Action demandée
$action = $_GET['action'] ?? 'home';

if (isset($routes[$action])) {
  $route = CONTROLLERS_PATH . '/' . $routes[$action];
  require_once $route;
} else {
  require_once CONTROLLERS_PATH . '/core/errorController.php';
}
