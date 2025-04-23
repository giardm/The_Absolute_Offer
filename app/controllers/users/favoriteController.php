<?php

/**
 * ======================================================
 * Contrôleur AJAX pour la gestion des favoris.
 * Gère l'ajout (POST) et la suppression (DELETE) d'un favori.
 * ======================================================
 */

require_once MODELS_PATH . '/favorites.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  // Lecture des données JSON envoyées dans la requête
  $input = json_decode(file_get_contents("php://input"), true);

  // Récupération des identifiants utilisateur et jeu
  $userId = $_SESSION['user_id'] ?? null;
  $gameId = $input['game_id'] ?? null;

  // Vérification de la présence des paramètres obligatoires
  if (!$userId || !$gameId || !ctype_digit((string) $gameId)) {
    echo json_encode([
      'success' => false,
      'message' => 'ID du jeu manquant ou invalide.'
    ]);
    exit;
  }

  // Ajout du jeu aux favoris
  $result = addFavorite($gameId, $userId);

  if ($result) {
    echo json_encode([
      'success' => true,
      'message' => 'Jeu ajouté aux favoris.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Erreur lors de l\'ajout aux favoris.'
    ]);
  }

  exit;
}

// ===============================
//  Traitement de la soumission AJAX (DELETE)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  header('Content-Type: application/json');

  // Lecture des données JSON envoyées dans la requête
  $input = json_decode(file_get_contents("php://input"), true);
  $favoriteId = $input['favoriteId'] ?? null;

  // Vérification de l'identifiant du favori
  if (!$favoriteId || !ctype_digit((string) $favoriteId)) {
    echo json_encode([
      'success' => false,
      'message' => 'ID du favori manquant ou invalide.'
    ]);
    exit;
  }

  // Suppression du favori
  $result = deleteFavorite($favoriteId);

  if ($result['success']) {
    echo json_encode([
      'success' => true,
      'message' => 'Jeu supprimé des favoris.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Erreur lors de la suppression du favori.'
    ]);
  }

  exit;
}
