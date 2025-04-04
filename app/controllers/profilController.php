<?php
require_once MODELS_PATH . '/userModel.php';

$user = getUserByEmailOrUsername($_SESSION['username']);

require_once VIEWS_PATH . '/partials/headerView.php';
require_once VIEWS_PATH . '/profilView.php';
require_once VIEWS_PATH . '/partials/footerView.php';
