<?php

require_once MODELS_PATH . '/connexionDB.php';

function getFeaturedOffers()
{
  $featuredGames = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT steam_id, api_id, game_title FROM featured_offers ORDER BY added_at DESC LIMIT 5;
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
  try {
    $pdo = connexionPDO();
    $sql = "
        INSERT INTO featured_offers (steam_id, api_id, user_id, game_title)
        VALUES (:steam_id, :api_id, :user_id, :game_title)
    ";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
      ':steam_id'   => $steamId,
      ':api_id'     => $apiId,
      ':user_id'    => $userId,
      ':game_title' => $gameTitle
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
