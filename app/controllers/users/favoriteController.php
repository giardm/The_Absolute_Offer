<?php
require_once MODELS_PATH . '/favorites.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  $gameId = $input['game_id'] ?? null;

  $input = json_decode(file_get_contents("php://input"), true);

  $userId = $_SESSION['user_id'];
  $gameId = $input['game_id'];

  if (!$gameId) {
    echo json_encode([
      'success' => false,
      'message' => 'ID du jeu manquant.'
    ]);
    exit;
  }
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
  $input = json_decode(file_get_contents("php://input"), true);
  $favoriteId = $input['favoriteId'] ?? null;

  $result = deleteFavorite($favoriteId);

  if ($result['success']) {
    echo json_encode([
      'success' => true,
      'message' => 'Jeu supprimé des favoris.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => ' Erreur lors de la suppresion du favori.'
    ]);
  }

  exit;
}
