<?php
require_once RACINE . ("/config/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : 'intro';

switch ($action) {
  case 'home':
    require_once RACINE . ("/app/controllers/home_ctlr.php");
    break;

  case 'profil':
    require_once RACINE . ("/app/controllers/profil_ctlr.php");
    break;

  default:
    require_once RACINE . ("/app/controllers/home_ctlr.php");
    break;
}
