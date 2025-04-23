<?php

// ===============================
//  Traitement de la requête DELETE AJAX
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  header('Content-Type: application/json');
  $input = json_decode(file_get_contents("php://input"), true);
  $userId = $_SESSION['user_id'] ?? null;

  $result = deleteAccount($userId);

  if ($result['success']) {
    echo json_encode([
      'success' => true,
      'message' => 'Compte supprimé.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Erreur lors de la suppression du compte.'
    ]);
  }

  exit;
}

// Sinon, on affiche la vue
require_once VIEWS_PATH . '/users/deleteProfilView.php';
