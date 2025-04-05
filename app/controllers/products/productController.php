<?php
$gameId = $_GET['id'] ?? null;

if (!$gameId) {
  die("Jeu non spécifié");
}

require_once VIEWS_PATH . ('/partials/headerView.php');
require_once VIEWS_PATH . ('/productView.php');
require_once VIEWS_PATH . ('/partials/footerView.php');
