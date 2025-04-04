<?php
require_once MODELS_PATH . '/userModel.php';
// ===============================
//  Verification etat de connexion
// ===============================

if (isLoggedOn()) {
  die(var_dump($_SESSION['user']));
}

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  $identifier = $_POST['identifier'] ?? '';
  $password = $_POST['password'] ?? '';

  $user = getUserByEmailOrUsername($identifier);

  if ($user && password_verify($password, $user['hash_password'])) {
    $_SESSION['user_id'] = $user['user_id'];

    echo json_encode([
      'success' => true,
      'message' => 'Connexion réussie.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Identifiants invalides.'
    ]);
  }

  exit;
}

// ===============================
//  Affichage du formulaire (GET)
// ===============================

require_once VIEWS_PATH . '/partials/headerView.php';
require_once VIEWS_PATH . '/loginView.php';
require_once VIEWS_PATH . '/partials/FooterView.php';
