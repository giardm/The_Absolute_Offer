<?php
require_once MODELS_PATH . '/userModel.php';

if (isLoggedOn()) {
  require_once CONTROLLERS_PATH . '/users/profilController.php';
}

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération et nettoyage des données
  $email = trim($_POST['email'] ?? '');
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm_password = $_POST['confirmPassword'] ?? '';

  // Vérifications
  if ($password !== $confirm_password) {
    echo json_encode([
      'success' => false,
      'message' => 'Les mots de passe ne correspondent pas.'
    ]);
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'success' => false,
      'message' => 'Adresse e-mail invalide.'
    ]);
  }

  if (strlen($password) < 6) {
    echo json_encode([
      'success' => false,
      'message' => 'Le mot de passe doit contenir au moins 6 caractères.'
    ]);
    exit;
  }

  // Hachage du mot de passe
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Enregistrement
  $result = createUser($email, $username, $hashedPassword);

  echo json_encode([
    'success' => $result['success'],
    'message' => $result['message']
  ]);
  exit;

  exit;
}

// ===============================
//  Affichage du formulaire (GET)
// ===============================

require_once VIEWS_PATH . '/users/registerView.php';
