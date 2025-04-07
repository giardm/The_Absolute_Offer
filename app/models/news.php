<?php
require_once MODELS_PATH . '/connexionDB.php';

function getNews()
{
  $news = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT news_id, title, thumb FROM news ORDER BY added_at DESC LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $news = $stmt->fetchAll();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $news;
}
