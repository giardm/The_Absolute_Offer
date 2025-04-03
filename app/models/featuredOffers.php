<?php

require_once MODELS_PATH . '/connexionDB.php';

function getFeaturedOffers()
{
  $featuredGames = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT steam_id, api_id FROM featured_offers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $featuredGames = $stmt->fetchAll();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $featuredGames;
}














//require_once(__DIR__ . '/connexionDB.php');
// die(MODELS_PATH . '/connexionDB.php');
// require_once(MODELS_PATH . '/connexionDB.php');

// header('Content-Type: application/json');

// try {
//   $pdo = connexionPDO();
//   $sql = "SELECT steam_id, api_id FROM featured_offers";
//   $stmt = $pdo->prepare($sql);
//   $stmt->execute();

//   $featured_offers_ids = $stmt->fetchAll();

//   echo json_encode($featured_offers_ids);
// } catch (PDOException $e) {
//   http_response_code(500);
//   echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()]);
// }
