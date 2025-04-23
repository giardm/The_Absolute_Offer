<?php
require_once MODELS_PATH . '/connexionDb.php';

function getNews($limit)
{
  $news = array();
  $limit = (int)$limit;

  try {
    $pdo = connexionPDO();
    $sql = "SELECT news_id, title, thumb_path, thumb_alt FROM news ORDER BY added_at DESC LIMIT :limit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'limit' => $limit
    ]);
    $news = $stmt->fetchAll();
  } catch (PDOException $e) {
    error_log("Erreur dans getNews : " . $e->getMessage());
  }
  return $news;
}


function getCategories()
{
  $categories = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT * FROM categories";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll();
  } catch (PDOException $e) {
    error_log("Erreur dans getCategories : " . $e->getMessage());
  }
  return $categories;
}


function getArticleById($newsId)
{
  $newsId = (int)$newsId;

  try {
    $pdo = connexionPDO();
    $stmt = $pdo->prepare("
      SELECT news.*, users.username, categories.name AS category_name
      FROM news
      JOIN users ON news.user_id = users.user_id
      JOIN categories ON news.category_id = categories.category_id
      WHERE news.news_id = :id
    ");

    $stmt->execute(['id' => $newsId]);

    $article = $stmt->fetch();
  } catch (PDOException $e) {
    error_log("Erreur dans getArticleById : " . $e->getMessage());
  }
  return $article;
}


function addArticle($title, $content, $thumbPath, $thumbAlt, $userId, $categoryId)
{
  $userId = (int)$userId;
  $categoryId = (int)$categoryId;

  try {
    $pdo = connexionPDO();

    $stmt = $pdo->prepare("INSERT INTO news (
      title,
      content,
      thumb_path,
      thumb_alt,
      added_at,
      user_id,
      category_id
    ) VALUES (
      :title,
      :content,
      :thumb_path,
      :thumb_alt,
      NOW(),
      :user_id,
      :category_id
    );");

    return $stmt->execute([
      ':title' => $title,
      ':content' => $content,
      ':thumb_path' => $thumbPath,
      ':thumb_alt' => $thumbAlt,
      ':user_id' => $userId,
      ':category_id' => $categoryId
    ]);
  } catch (PDOException $e) {
    error_log("Erreur dans addArticle : " . $e->getMessage());
    return false;
  }
}
