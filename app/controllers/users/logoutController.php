<?php

/**
 * ======================================================
 * Contrôleur de déconnexion.
 * Déconnecte l'utilisateur puis redirige vers la page d'accueil.
 * ======================================================
 */

require_once MODELS_PATH . '/userModel.php';

// Déconnexion de l'utilisateur (destruction de session)
logout();

// Redirection interne vers la page d'accueil
$action = "home";
require_once CONTROLLERS_PATH . '/home/homeController.php';
