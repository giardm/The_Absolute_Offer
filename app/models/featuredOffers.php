<?php

require_once MODELS_PATH . '/connexionDb.php';

function getFeaturedOffers()
{
  $featuredGames = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT steam_id, api_id, game_title, img_path FROM featured_offers ORDER BY added_at DESC LIMIT 5;
";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $featuredGames = $stmt->fetchAll();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $featuredGames;
}

function addFeaturedOffer($steamId,  $apiId,  $userId,  $gameTitle)
{
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
      ':img_path' => $imgPath
    ]);
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
}

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
    print "Erreur !: " . $e->getMessage();
  }
}

function importSteamImage($steamId, $title)
{
  $imageUrl = "https://cdn.akamai.steamstatic.com/steam/apps/$steamId/library_600x900.jpg";
  $destinationFolder = BASE_PATH . '/public/images/games/';

  if (!is_dir($destinationFolder)) {
    mkdir($destinationFolder, 0755, true);
  }

  $filename = strtolower($title);
  $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
  $filename = trim($filename, '-');

  $tempPath = $destinationFolder . $filename . '.jpg';
  $webpPath = $destinationFolder . $filename . '.webp';

  $downloaded = downloadSteamImage($imageUrl, $tempPath);
  if (!$downloaded) {
    return null;
  }

  $image = @imagecreatefromjpeg($tempPath);
  if (!$image) {
    $image = @imagecreatefrompng($tempPath);
  }

  if (!$image) {
    unlink($tempPath);
    return null;
  }

  imagewebp($image, $webpPath, 80);
  imagedestroy($image);
  unlink($tempPath);

  return 'public/images/games/' . $filename . '.webp';
}

function downloadSteamImage($url, $destinationPath)
{
  $imageData = @file_get_contents($url);

  if ($imageData === false) {
    return false;
  }

  $result = file_put_contents($destinationPath, $imageData);
  return $result !== false;
}
