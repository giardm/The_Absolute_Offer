<?php

require dirname(__DIR__) . "/config/config.php";
// Chargement des fichiers nécessaires
require_once RACINE . '/app/controllers/router.php';

// Initialiser le routeur
$router = new Router();

// Définir les routes
$router->addRoute('home', 'home_ctlr', 'index'); // Correspond à /home

// Lancer le traitement de la requête
$router->dispatch();
