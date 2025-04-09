<?php
require_once MODELS_PATH . '/connexionDB.php';

function getNews()
{
  $news = array();

  try {
    $pdo = connexionPDO();
    $sql = "SELECT news_id, title, thumb_path, thumb_alt FROM news ORDER BY added_at DESC LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $news = $stmt->fetchAll();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
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
    print "Erreur !: " . $e->getMessage();
  }
  return $categories;
}

function getArticleById($newsId)
{
  try {
    $pdo = connexionPDO();
    $stmt = $pdo->prepare("SELECT news.*, users.username, categories.name 
    AS category_name
    FROM news
    JOIN users ON news.user_id = users.user_id
    JOIN categories ON news.category_id = categories.category_id
    WHERE news.news_id = :id
");

    $stmt->execute(['id' => $newsId]);

    $article = $stmt->fetch();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
  return $article;
}

function addArticle($title, $content, $thumbPath, $thumbAlt, $userId, $categoryId)
{
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

    // Exécution de la requête préparée
    return $stmt->execute([
      ':title' => $title,
      ':content' => $content,
      ':thumb_path' => $thumbPath,
      ':thumb_alt' => $thumbAlt,
      ':user_id' => $userId,
      ':category_id' => $categoryId
    ]);
  } catch (PDOException $e) {
    error_log("Erreur SQL : " . $e->getMessage());
    return false;
  }
}
