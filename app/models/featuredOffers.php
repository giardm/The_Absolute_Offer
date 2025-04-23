<?php

/**
 * ======================================================
 * Gère les offres mises en avant sur le site :
 * récupération, ajout, suppression automatique et gestion des images.
 * ======================================================
 */

require_once MODELS_PATH . '/connexionDb.php';

/**
 * Récupère les 5 dernières offres mises en avant depuis la base de données.
 *
 * @return array - Tableau contenant les offres mises en avant
 */
function getFeaturedOffers()
{
  $featuredGames = array();

  try {
    // Connexion à la base de données
    $pdo = connexionPDO();

    // Requête pour récupérer les offres récentes
    $sql = "SELECT steam_id, api_id, game_title, img_path FROM featured_offers ORDER BY added_at DESC LIMIT 5;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupération des résultats
    $featuredGames = $stmt->fetchAll();
  } catch (PDOException $e) {
    error_log("Erreur dans getFeaturedOffers : " . $e->getMessage());
  }

  return $featuredGames;
}

/**
 * Ajoute une offre mise en avant dans la base de données.
 *
 * @param int $steamId - Identifiant Steam du jeu
 * @param int $apiId - Identifiant interne de l'API
 * @param int $userId - Identifiant de l'utilisateur ayant ajouté l'offre
 * @param string $gameTitle - Titre du jeu
 * @return bool - Résultat de l'opération (true si succès, false sinon)
 */
function addFeaturedOffer($steamId, $apiId, $userId, $gameTitle)
{
  $steamId = (int)$steamId;
  $apiId = (int)$apiId;
  $userId = (int)$userId;

  // Récupération et traitement de l'image
  $imgPath = importSteamImage($steamId, $gameTitle);

  try {
    $pdo = connexionPDO();
    $sql = "
        INSERT INTO featured_offers (steam_id, api_id, user_id, game_title, img_path)
        VALUES (:steam_id, :api_id, :user_id, :game_title, :img_path)
    ";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
      ':steam_id'   => $steamId,
      ':api_id'     => $apiId,
      ':user_id'    => $userId,
      ':game_title' => $gameTitle,
      ':img_path'   => $imgPath
    ]);
  } catch (PDOException $e) {
    error_log("Erreur dans addFeaturedOffer : " . $e->getMessage());
  }
}

/**
 * Supprime toutes les offres mises en avant sauf les 5 plus récentes.
 *
 * @return void
 */
function cleanupFeaturedOffers()
{
  try {
    $pdo = connexionPDO();
    $sql = "
      DELETE FROM featured_offers
      WHERE featured_offer_id NOT IN (
        SELECT featured_offer_id
        FROM (
          SELECT featured_offer_id
          FROM featured_offers
          ORDER BY added_at DESC
          LIMIT 5
        ) AS to_keep
      )
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
  } catch (PDOException $e) {
    error_log("Erreur dans cleanupFeaturedOffers : " . $e->getMessage());
  }
}

/**
 * Télécharge une image Steam, la convertit en WebP, et retourne son chemin.
 *
 * @param int $steamId - Identifiant Steam du jeu
 * @param string $title - Titre du jeu (pour nom de fichier)
 * @return string|null - Chemin relatif de l'image WebP ou null si échec
 */
function importSteamImage($steamId, $title)
{
  $steamId = (int)$steamId;

  $imageUrl = "https://cdn.akamai.steamstatic.com/steam/apps/$steamId/library_600x900.jpg";
  $destinationFolder = BASE_PATH . '/public/images/games/';

  // Création du dossier si inexistant
  if (!is_dir($destinationFolder)) {
    mkdir($destinationFolder, 0755, true);
  }

  // Génère un nom de fichier propre à partir du titre
  $filename = strtolower($title);
  $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
  $filename = trim($filename, '-');
  $filename = substr($filename, 0, 100);

  $tempPath = $destinationFolder . $filename . '.jpg';
  $webpPath = $destinationFolder . $filename . '.webp';

  // Téléchargement de l'image
  $downloaded = downloadSteamImage($imageUrl, $tempPath);
  if (!$downloaded) {
    return null;
  }

  // Vérifie si le fichier téléchargé est une image valide
  $imageType = exif_imagetype($tempPath);
  if (!in_array($imageType, [IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
    unlink($tempPath);
    return null;
  }

  // Création de l'image depuis le format d'origine
  $image = @imagecreatefromjpeg($tempPath);
  if (!$image) {
    $image = @imagecreatefrompng($tempPath);
  }

  // Si l'image est illisible, on nettoie et on arrête
  if (!$image) {
    unlink($tempPath);
    return null;
  }

  // Conversion en WebP, nettoyage mémoire
  imagewebp($image, $webpPath, 80);
  imagedestroy($image);
  unlink($tempPath);

  return 'public/images/games/' . $filename . '.webp';
}

/**
 * Télécharge une image depuis une URL Steam et la stocke localement.
 *
 * @param string $url - URL de l’image à télécharger
 * @param string $destinationPath - Chemin local où enregistrer l’image
 * @return bool - true si le téléchargement a réussi, false sinon
 */
function downloadSteamImage($url, $destinationPath)
{
  // Vérifie que l'URL est bien une URL Steam
  if (strpos($url, 'https://cdn.akamai.steamstatic.com/steam/apps/') !== 0) {
    return false;
  }

  // Prépare un contexte sécurisé pour la requête HTTP
  $context = stream_context_create([
    'http' => [
      'timeout' => 5,
      'follow_location' => true,
      'header' => "User-Agent: Mozilla/5.0\r\n"
    ]
  ]);

  // Téléchargement de l’image
  $imageData = @file_get_contents($url, false, $context);

  // Vérifie que le fichier n'est pas vide ou invalide
  if ($imageData === false || strlen($imageData) < 500) {
    return false;
  }

  // Enregistrement local de l'image
  $result = file_put_contents($destinationPath, $imageData);
  return $result !== false;
}
