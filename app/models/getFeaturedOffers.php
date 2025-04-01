<?php
require_once __DIR__ . '/../../config/config.php';

header('Content-Type: application/json');

try {
  $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ]);

  $sql = "SELECT steam_id, api_id FROM featured_offers";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $featured_offers_ids = $stmt->fetchAll();
  echo json_encode($featured_offers_ids);
} catch (PDOException $e) {
  echo json_encode(["error" => $e->getMessage()]);
}
