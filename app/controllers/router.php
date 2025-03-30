<?php
require_once BASE_PATH . ("/config/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
  case 'home':
    require_once CONTROLLERS_PATH. ("/home_ctlr.php");
    break;

  case 'profil':
    require_once CONTROLLERS_PATH. ("/profil_ctlr.php");
    break;

  default:
    require_once CONTROLLERS_PATH. ("/error_ctlr.php");
    break;
}
