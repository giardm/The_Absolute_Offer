<?php

/**
 * ======================================================
 * Contrôleur de connexion utilisateur.
 * Gère la soumission du formulaire (POST) et l'affichage (GET).
 * ======================================================
 */

require_once MODELS_PATH . '/userModel.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  // Récupération des champs du formulaire
  $identifier = $_POST['identifier'] ?? '';
  $password = $_POST['password'] ?? '';

  // Vérifie que les champs ne sont pas vides
  if (empty($identifier) || empty($password)) {
    echo json_encode([
      'success' => false,
      'message' => 'Veuillez remplir tous les champs.'
    ]);
    exit;
  }

  // Recherche de l'utilisateur par email ou nom d'utilisateur
  $user = getUserByEmailOrUsername($identifier);

  // Vérification du mot de passe si l'utilisateur existe
  if ($user && password_verify($password, $user['hash_password'])) {
    // Stockage des informations de session
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['tao_role'] = $user['role'];
    $_SESSION['username'] = $user['username'];

    echo json_encode([
      'success' => true,
      'message' => 'Connexion réussie.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Identifiants incorrects.'
    ]);
  }

  exit;
}

// ===============================
//  Affichage du formulaire (GET)
// ===============================
require_once VIEWS_PATH . '/users/loginView.php';
