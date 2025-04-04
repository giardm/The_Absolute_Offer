<?php

/**
 * steamController.php
 * -------------------
 * Proxy sécurisé entre le front-end et l'API publique Steam Store.
 * Objectifs :
 *   - Éviter les erreurs CORS sur les appels front-end (fetch côté JS)
 *   - Centraliser et sécuriser les requêtes vers Steam
 *   - Mettre en place une protection anti-abus légère
 *   - Prévoir des extensions futures (ex: cache, logs)
 */

// =====================================================================
// 1. SÉCURITÉ : Restreindre aux requêtes GET uniquement
// =====================================================================
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  http_response_code(405); // Méthode non autorisée
  echo json_encode(['error' => 'Méthode non autorisée.']);
  exit;
}

// =====================================================================
// 2. VALIDATION : Vérification stricte de l'identifiant du jeu (appid)
// =====================================================================
$appid = $_GET['appid'] ?? null;

if (!$appid || !ctype_digit($appid)) {
  http_response_code(400); // Mauvaise requête
  echo json_encode(['error' => 'Paramètre appid invalide ou manquant.']);
  exit;
}

// =====================================================================
// 3. ANTI-ABUS : Limiter les appels répétés par IP + appid
// =====================================================================
$clientIP = $_SERVER['REMOTE_ADDR'];
$hash = md5("steam-$appid-$clientIP"); // Clé unique par utilisateur et jeu
$tempFile = sys_get_temp_dir() . "/$hash";

// Si un appel a été fait récemment (< 2 sec), on bloque
if (file_exists($tempFile)) {
  $lastCall = filemtime($tempFile);
  if (time() - $lastCall < 2) {
    http_response_code(429); // Trop de requêtes
    echo json_encode(['error' => 'Trop de requêtes. Veuillez patienter.']);
    exit;
  }
}
touch($tempFile); // Marque l'appel actuel comme le dernier

// =====================================================================
// 4. CORS : Autoriser uniquement les domaines de confiance (à adapter)
// =====================================================================
$allowedOrigins = ['https://The_Absolute_Offer.com', 'http://localhost'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// Si l'origine est autorisée, on l'autorise explicitement
if (in_array($origin, $allowedOrigins)) {
  header("Access-Control-Allow-Origin: $origin");
} else {
  // Par défaut, limiter à un domaine spécifique
  header('Access-Control-Allow-Origin: https://tonsite.com');
}

// Réponse JSON par défaut
header('Content-Type: application/json');

// =====================================================================
// 5. APPEL VERS L’API STEAM
// =====================================================================
$steamUrl = "https://store.steampowered.com/api/appdetails?appids=$appid&cc=fr&l=fr";

$options = [
  'http' => [
    'timeout' => 5,                    // Timeout max : 5 sec
    'ignore_errors' => true,           // Accepte les erreurs HTTP 40x/50x
    'header' => "User-Agent: SteamProxyFetcher/1.0\r\n" // User-Agent propre
  ]
];

$context = stream_context_create($options);
$response = @file_get_contents($steamUrl, false, $context);

// =====================================================================
// 6. GESTION DES ERREURS LORS DE L’APPEL
// =====================================================================
if ($response === false) {
  http_response_code(502); // Bad Gateway
  echo json_encode(['error' => 'Erreur de récupération depuis Steam.']);
  exit;
}

// =====================================================================
// 7. RENVOI DES DONNÉES AU CLIENT
// =====================================================================
echo $response;
