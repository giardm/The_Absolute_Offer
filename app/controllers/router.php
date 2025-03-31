<?php
require_once BASE_PATH . ("/config/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
  case 'home':
    require_once CONTROLLERS_PATH . ("/homeController.php");
    break;

  case 'search':
    require_once CONTROLLERS_PATH . ("/searchController.php");
    break;

  case 'product':
    require_once CONTROLLERS_PATH . ("/productController.php");
    break;

  case 'profil':
    require_once CONTROLLERS_PATH . ("/profilController.php");
    break;

  default:
    require_once CONTROLLERS_PATH . ("/errorController.php");
    break;
}
