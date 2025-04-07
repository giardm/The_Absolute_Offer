<?php
require_once MODELS_PATH . '/newsModel.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   header('Content-Type: application/json');

//   $identifier = $_POST['identifier'] ?? '';
//   $password = $_POST['password'] ?? '';

//   $user = getUserByEmailOrUsername($identifier);

//   if ($user && password_verify($password, $user['hash_password'])) {
//     $_SESSION['user_id'] = $user['user_id'];
//     $_SESSION['role'] = $user['role'];
//     $_SESSION['username'] = $user['username'];

//     echo json_encode([
//       'success' => true,
//       'message' => 'Connexion réussie.'
//     ]);
//   } else {
//     echo json_encode([
//       'success' => false,
//       'message' => 'Identifiants invalides.'
//     ]);
//   }

//   exit;
// }

// ===============================
//  Affichage du formulaire (GET)
// ===============================

require_once VIEWS_PATH . '/partials/headerView.php';
require_once VIEWS_PATH . '/addArticleView.php';
require_once VIEWS_PATH . '/partials/FooterView.php';
