<?php
require_once MODELS_PATH . '/userModel.php';

logout();
$action = "home";
require_once CONTROLLERS_PATH . '/home/homeController.php';
