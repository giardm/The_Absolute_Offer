<?php

/**
 * ======================================================
 * Contrôleur d'inscription utilisateur.
 * Gère la soumission du formulaire (POST) et l'affichage (GET).
 * ======================================================
 */

require_once MODELS_PATH . '/userModel.php';

// Si l'utilisateur est déjà connecté, on charge directement son profil
if (isLoggedOn()) {
  require_once CONTROLLERS_PATH . '/users/profilController.php';
}

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération et nettoyage des données envoyées
  $email = trim($_POST['email'] ?? '');
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm_password = $_POST['confirmPassword'] ?? '';

  // Vérifie que les mots de passe correspondent
  if ($password !== $confirm_password) {
    echo json_encode([
      'success' => false,
      'message' => 'Les mots de passe ne correspondent pas.'
    ]);
    exit;
  }

  // Vérifie que l'adresse email est valide
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'success' => false,
      'message' => 'Adresse e-mail invalide.'
    ]);
    exit;
  }

  // Vérifie la longueur minimale du mot de passe
  if (strlen($password) < 6) {
    echo json_encode([
      'success' => false,
      'message' => 'Le mot de passe doit contenir au moins 6 caractères.'
    ]);
    exit;
  }

  // Hachage sécurisé du mot de passe
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Enregistrement de l'utilisateur dans la base
  $result = createUser($email, $username, $hashedPassword);

  // Réponse JSON avec succès ou message d'erreur
  echo json_encode([
    'success' => $result['success'],
    'message' => $result['message']
  ]);
  exit;
}

// ===============================
//  Affichage du formulaire (GET)
// ===============================
require_once VIEWS_PATH . '/users/registerView.php';
