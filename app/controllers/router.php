<?php

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

  case 'login':
    require_once CONTROLLERS_PATH . ("/loginController.php");
    break;

  default:
    require_once CONTROLLERS_PATH . ("/errorController.php");
    break;
}
