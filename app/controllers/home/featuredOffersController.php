<?php

/**
 * ======================================================
 * Contrôleur AJAX : Ajoute un jeu à la liste des offres mises en avant.
 * Reçoit une requête POST JSON et appelle les fonctions du modèle.
 * ======================================================
 */

require_once MODELS_PATH . "/featuredOffers.php";
require_once MODELS_PATH . "/connexionDb.php";

// Définition du type de contenu attendu en sortie : JSON
header('Content-Type: application/json');

// Vérifie que la méthode HTTP utilisée est bien POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); // Méthode non autorisée
  echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
  exit;
}

// Récupération et décodage des données JSON envoyées dans la requête
$input = json_decode(file_get_contents("php://input"), true);

// Vérification des paramètres requis
if (!isset($input['steam_id'], $input['api_id'], $_SESSION['user_id'], $input['game_title'])) {
  http_response_code(400); // Requête invalide
  echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
  exit;
}

// Appel de la fonction d'ajout avec les paramètres fournis
$success = addFeaturedOffer(
  $input['steam_id'],
  $input['api_id'],
  $_SESSION['user_id'],
  trim($input['game_title']) // Nettoyage léger du titre
);

// Nettoyage des anciennes offres si ajout réussi
if ($success) {
  cleanupFeaturedOffers();
}

// Envoi de la réponse JSON avec succès ou message d’erreur
echo json_encode([
  'success' => $success,
  'message' => $success ? 'Jeu ajouté avec succès !' : 'Échec de l’ajout.'
]);
