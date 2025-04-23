<?php

/**
 * ======================================================
 * Contrôleur de suppression de compte utilisateur.
 * Gère la requête DELETE AJAX pour supprimer le compte actuel,
 * sinon affiche la vue de confirmation.
 * ======================================================
 */

// ===============================
//  Traitement de la requête DELETE AJAX
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  header('Content-Type: application/json');

  // Récupération des données envoyées (même si ici, inutilisées)
  $input = json_decode(file_get_contents("php://input"), true);

  // Vérifie que l'utilisateur est bien connecté
  $userId = $_SESSION['user_id'] ?? null;

  if (!$userId) {
    echo json_encode([
      'success' => false,
      'message' => 'Utilisateur non authentifié.'
    ]);
    exit;
  }

  // Appel de la fonction de suppression
  $result = deleteAccount($userId);

  // Réponse JSON selon le résultat
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

// ===============================
//  Affichage de la page de confirmation (GET)
// ===============================
require_once VIEWS_PATH . '/users/deleteProfilView.php';
