<?php
require_once MODELS_PATH . '/userModel.php';

if isLoggedOn()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Vérifications
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse e-mail invalide.");
    }

    if (strlen($password) < 6) {
        die("Le mot de passe doit contenir au moins 6 caractères.");
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Enregistrement
    $result = createUser($email, $username, $hashedPassword);

    if ($result) {
        echo "Inscription réussie. <a href='/login'>Connectez-vous</a>";
    } else {
        echo "Erreur : L'utilisateur existe peut-être déjà.";
    }
} else {
    include VIEWS_PATH . '/partials/headerView.php';
    include VIEWS_PATH . '/registerView.php';
    include VIEWS_PATH . '/partials/footerView.php';
}
