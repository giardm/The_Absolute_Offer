<?php

/**
 * ======================================================
 * Gère les opérations liées aux actualités et aux catégories :
 * récupération des news, ajout d’un article, et accès aux catégories.
 * ======================================================
 */

require_once MODELS_PATH . '/connexionDb.php';

/**
 * Récupère un nombre limité d’actualités récentes.
 *
 * @param int $limit - Nombre maximum d'actualités à récupérer
 * @return array - Liste des actualités
 */
function getNews($limit)
{
  $news = array();
  $limit = (int)$limit;

  try {
    // Connexion à la base de données
    $pdo = connexionPDO();

    // Préparation de la requête SQL avec une limite
    $sql = "SELECT news_id, title, thumb_path, thumb_alt FROM news ORDER BY added_at DESC LIMIT $limit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupération des résultats
    $news = $stmt->fetchAll();
  } catch (PDOException $e) {
    error_log("Erreur dans getNews : " . $e->getMessage());
  }

  return $news;
}

/**
 * Récupère toutes les catégories disponibles dans la base de données.
 *
 * @return array - Liste des catégories
 */
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

/**
 * Récupère un article spécifique avec ses informations liées (auteur et catégorie).
 *
 * @param int $newsId - Identifiant de l'article
 * @return array|null - Données de l'article ou null si non trouvé
 */
function getArticleById($newsId)
{
  $newsId = (int)$newsId;

  try {
    $pdo = connexionPDO();

    // Requête avec jointures pour récupérer l'article + auteur + catégorie
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

/**
 * Ajoute un nouvel article dans la base de données.
 *
 * @param string $title - Titre de l'article
 * @param string $content - Contenu principal de l'article
 * @param string $thumbPath - Chemin de l'image miniature
 * @param string $thumbAlt - Texte alternatif de l’image
 * @param int $userId - ID de l'utilisateur auteur
 * @param int $categoryId - ID de la catégorie associée
 * @return bool - true si l'insertion réussit, false sinon
 */
function addArticle($title, $content, $thumbPath, $thumbAlt, $userId, $categoryId)
{
  $userId = (int)$userId;
  $categoryId = (int)$categoryId;

  try {
    $pdo = connexionPDO();

    // Insertion d'un nouvel article avec les champs requis
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
