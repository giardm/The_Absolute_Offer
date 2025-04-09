<?php
$gameId = $_GET['id'] ?? null;

if (!$gameId) {
  die("Jeu non spécifié");
}

require_once VIEWS_PATH . ('/search/productView.php');
