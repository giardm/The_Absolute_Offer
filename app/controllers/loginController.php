<?php
require_once MODELS_PATH . '/auth.php';
require_once MODELS_PATH . '/userModel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_or_email = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = getUserByEmailOrUsername($username_or_email);

    if (!$user || !password_verify($password, $user['hash_password'])) {
        echo "Identifiants incorrects.";
        exit;
    }

    // Stocker l'utilisateur en session
    $_SESSION['user'] = [
        'id' => $user['user_id'],
        'username' => $user['username'],
        'role' => $user['role']
    ];

    // Redirection après connexion
    header("Location: index.php?action=home");

    exit;
} else {
    include VIEWS_PATH. '/partials/headerView.php';
    include VIEWS_PATH. '/loginView.php';
    include VIEWS_PATH. '/partials/footerView.php';
}
