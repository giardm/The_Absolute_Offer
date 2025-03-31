<?php
$gameId = $_GET['id'] ?? null;

$gameData = null;

if ($gameId) {
  $apiUrl = "https://www.cheapshark.com/api/1.0/games?id=" . urlencode($gameId);
  $response = file_get_contents($apiUrl);
  $gameData = json_decode($response, true);
}

$steamAppID = $gameData['info']['steamAppID'] ?? null;
$steamData = null;

if ($steamAppID) {
  $steamApiUrl = "https://store.steampowered.com/api/appdetails?appids=" . urlencode($steamAppID);
  $steamResponse = file_get_contents($steamApiUrl);
  $steamJson = json_decode($steamResponse, true);

  if ($steamJson && $steamJson[$steamAppID]['success']) {
    $steamData = $steamJson[$steamAppID]['data'];
  }
}

if (!$gameId) {
  die("Jeu non spécifié");
}

require_once VIEWS_PATH . ('/partials/headerView.php');
require_once VIEWS_PATH . ('/productView.php');
require_once VIEWS_PATH . ('/partials/footerView.php');
