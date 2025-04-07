<?php

/**
 * steamController.php
 * -------------------
 * Proxy simple entre le front-end et l'API publique Steam Store.
 * Objectifs :
 *   - Éviter les erreurs CORS côté client
 *   - Assurer une utilisation responsable sans se faire passer pour un autre client
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
// 4. REQUÊTE : Appel à l'API publique Steam Store
// =====================================================================
$url = "https://store.steampowered.com/api/appdetails?appids=$appid";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;

/*
========================================================================
 DISCLAIMER - USAGE RESPONSABLE DE L'API STEAM STORE
 -----------------------------------------------------------------------
 Ce script agit comme un proxy léger pour accéder aux données publiques 
 de la plateforme Steam via l'endpoint :
   https://store.steampowered.com/api/appdetails

  Il s'agit d'un scraping bienveillant :
   - Utilisation à des fins éducatives uniquement (projet étudiant).
   - Aucune intention commerciale ou de monétisation.
   - Pas d'usurpation d'identité : aucun User-Agent falsifié.
   - Accès uniquement à des données déjà publiquement disponibles.

  L'API utilisée est accessible sans authentification, sans clé API 
 et ne fait l'objet d'aucune restriction technique à ce jour.

  Ce projet n'est ni affilié, ni sponsorisé par Valve ou Steam.
 Les marques, visuels et contenus restent la propriété de leurs détenteurs.
========================================================================
*/
