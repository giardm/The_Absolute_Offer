<?php
require_once MODELS_PATH . '/userModel.php';
require_once MODELS_PATH . '/favorites.php';

if (!isset($_SESSION['user_id'])) {
    require_once VIEWS_PATH . '/users/loginView.php';
    exit;
}

$user = getUserByEmailOrUsername($_SESSION['username']);
$favorites = getFavorites($_SESSION['user_id'], 10);

require_once VIEWS_PATH . '/users/profilView.php';
