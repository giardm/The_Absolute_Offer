<?php
// ========================
// steamController.php
// Proxy vers l'API Steam Store (pour contourner CORS)
// ========================

// En-têtes pour permettre l'appel depuis JS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Vérifie que l'appid est présent et valide
$appid = $_GET['appid'] ?? null;

if (!$appid || !ctype_digit($appid)) {
  http_response_code(400);
  echo json_encode(['error' => 'Paramètre appid invalide ou manquant.']);
  exit;
}

// Prépare l'appel à l'API Steam officielle
$steamUrl = "https://store.steampowered.com/api/appdetails?appids=$appid&cc=fr&l=fr";
$response = @file_get_contents($steamUrl);

// Vérifie si la réponse est vide
if ($response === false) {
  http_response_code(502);
  echo json_encode(['error' => 'Erreur lors de la récupération des données Steam.']);
  exit;
}

// Retourne la réponse brute à JS
echo $response;
