<?php
require_once MODELS_PATH . "/featuredOffers.php";
require_once MODELS_PATH . "/connexionDb.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
  exit;
}

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['steam_id'], $input['api_id'], $input['user_id'], $input['game_title'])) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
  exit;
}

$success = addFeaturedOffer(
  $input['steam_id'],
  $input['api_id'],
  $input['user_id'],
  trim($input['game_title'])
);

echo json_encode([
  'success' => $success,
  'message' => $success ? 'Jeu ajouté avec succès !' : 'Échec de l’ajout.'
]);
