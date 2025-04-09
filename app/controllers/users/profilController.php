<?php
require_once MODELS_PATH . '/userModel.php';

$user = getUserByEmailOrUsername($_SESSION['username']);

require_once VIEWS_PATH . '/users/profilView.php';
