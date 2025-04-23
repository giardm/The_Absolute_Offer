<?php

/**
 * ======================================================
 * Contrôleur de la recherche de produits.
 * Récupère le terme de recherche envoyé en GET et charge la vue correspondante.
 * ======================================================
 */

// Récupération du terme de recherche depuis l'URL
$query = $_GET['query'] ?? '';

// Nettoyage basique du terme pour éviter les injections HTML
$query = trim(strip_tags($query));

// Inclusion de la vue de recherche
require_once VIEWS_PATH . '/search/searchView.php';
