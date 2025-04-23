<?php

/**
 * ======================================================
 * Routeur principal de l'application :
 * sélectionne le contrôleur à charger en fonction de l'action passée en URL.
 * ======================================================
 */

require_once MODELS_PATH . '/userModel.php';

// ======================================================
// Définition des routes : chaque action correspond à un contrôleur
// ======================================================
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
  'cgu'              => 'legals/cguController.php',
  'legalNotices'     => 'legals/legalNoticesController.php',
];

// ======================================================
// Titre de page correspondant à chaque action
// Utilisé pour l'affichage dynamique dans les vues
// ======================================================
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

// ======================================================
// Détermination de l'action demandée par l'utilisateur
// (par défaut, on charge la page d'accueil)
// ======================================================
$action = $_GET['action'] ?? 'home';

// ======================================================
// Si l'action existe dans les routes, on charge le contrôleur associé
// Sinon, on affiche une page d'erreur
// ======================================================
if (isset($routes[$action])) {
  $route = CONTROLLERS_PATH . '/' . $routes[$action];
  require_once $route;
} else {
  require_once CONTROLLERS_PATH . '/core/errorController.php';
}
