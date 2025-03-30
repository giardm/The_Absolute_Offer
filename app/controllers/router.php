<?php
require_once BASE_PATH . ("/config/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
  case 'home':
    require_once APP_PATH . ("/controllers/home_ctlr.php");
    break;

  case 'profil':
    require_once APP_PATH . ("/controllers/profil_ctlr.php");
    break;

  default:
    require_once APP_PATH . ("/controllers/error_ctlr.php");
    break;
}
