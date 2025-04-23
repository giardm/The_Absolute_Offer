<?php

/**
 * ======================================================
 * Contrôleur de profil utilisateur.
 * Affiche les informations du profil et ses favoris.
 * ======================================================
 */

require_once MODELS_PATH . '/userModel.php';
require_once MODELS_PATH . '/favorites.php';

// Vérifie que l'utilisateur est connecté via la session
if (!isset($_SESSION['user_id'])) {
  require_once VIEWS_PATH . '/users/loginView.php';
  exit;
}

// Récupération des informations utilisateur à partir du nom d'utilisateur
$user = getUserByEmailOrUsername($_SESSION['username']);

// Récupération des 10 derniers favoris de l'utilisateur
$favorites = getFavorites($_SESSION['user_id'], 10);

// Chargement de la vue du profil utilisateur
require_once VIEWS_PATH . '/users/profilView.php';
