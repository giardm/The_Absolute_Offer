<?php

/**
 * ======================================================
 * Contrôleur de gestion des actualités.
 * Affiche un article individuel ou la liste complète selon la présence d’un ID.
 * ======================================================
 */

require_once MODELS_PATH . '/newsModel.php';

// Récupère l'identifiant de l'article dans l'URL s'il est présent
$id = $_GET['id'] ?? null;

// ===============================
// Affichage d’un article précis
// ===============================
if ($id && ctype_digit($id)) {
  $id = (int)$id; // sécurisation supplémentaire

  // Récupération de l'article depuis le modèle
  $article = getArticleById($id);

  // Chargement de la vue de l'article individuel
  require_once VIEWS_PATH . '/news/newsArticleView.php';
} else {

  // ===============================
  // Affichage de la liste complète des actualités
  // ===============================

  // Récupération des 20 dernières actualités
  $news = getNews(20);

  // Chargement de la vue "toutes les actualités"
  require_once VIEWS_PATH . '/news/allNewsView.php';
}
