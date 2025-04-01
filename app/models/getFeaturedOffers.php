<?php
require_once __DIR__ . '/../../config/config.php';
// require_once BASE_PATH . "/config/config.php";todo POURQUOI CA MARCHE PAS ?????????????????????????????????


header('Content-Type: application/json');

try {
  $pdo = connexionPDO();
  $sql = "SELECT steam_id, api_id FROM featured_offers";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $featured_offers_ids = $stmt->fetchAll();

  echo json_encode($featured_offers_ids);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()]);
}
