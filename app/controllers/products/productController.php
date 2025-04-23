<?php

/**
 * ======================================================
 * Contrôleur d'affichage d'un produit (jeu).
 * Récupère l'ID du jeu depuis l'URL et inclut la vue correspondante.
 * La vue gère l'affichage si l'ID est invalide ou absent.
 * ======================================================
 */

// Récupération de l'ID du jeu passé en GET
$gameId = $_GET['id'] ?? null;

// Inclusion de la vue du produit
require_once VIEWS_PATH . '/search/productView.php';
