<?php
require_once MODELS_PATH . '/connexionDB.php';

function getNews()
{
  $news = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT news_id, title, thumb, thumb_alt FROM news ORDER BY added_at DESC LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $news = $stmt->fetchAll();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $news;
}

function getArticleById($newsId)
{
  try {
    $pdo = connexionPDO();
    $stmt = $pdo->prepare("
SELECT 
  news.*, 
  users.username, 
  categories.name AS category_name
FROM 
  news
JOIN users ON news.user_id = users.user_id
JOIN categories ON news.category_id = categories.category_id
WHERE 
  news.news_id = :id

  ");

    $stmt->execute(['id' => $newsId]);

    $article = $stmt->fetch();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $article;
}
