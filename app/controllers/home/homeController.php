<?php

/**
 * ======================================================
 * Contrôleur de la page d'accueil.
 * Charge les actualités et les favoris si l'utilisateur est connecté.
 * ======================================================
 */

require_once MODELS_PATH . '/newsModel.php';
require_once MODELS_PATH . '/favorites.php';
require_once MODELS_PATH . '/userModel.php';

// Récupération des 6 dernières actualités
$news = getNews(6);

// Si l'utilisateur est connecté, on récupère ses 3 derniers favoris
if (isLoggedOn()) {
  $favorites = getFavorites($_SESSION['user_id'], 3);
}

// Inclusion de la vue associée à la page d'accueil
require VIEWS_PATH . '/core/homeView.php';
