<?php

/**
 * ======================================================
 * Gère les opérations liées aux favoris des utilisateurs :
 * récupération, ajout et suppression de jeux favoris.
 * ======================================================
 */

require_once MODELS_PATH . '/connexionDb.php';

/**
 * Récupère la liste des jeux favoris d’un utilisateur.
 *
 * @param int $userId - Identifiant de l'utilisateur
 * @return array - Tableau contenant les favoris récupérés depuis la base de données
 */
function getFavorites($userId, $limit)
{
  $favorites = array();
  $limit = (int)$limit;
  $userId = (int)$userId;

  try {
    $pdo = connexionPDO();
    $sql = "SELECT * FROM favorites WHERE user_id=:userId ORDER BY added_at LIMIT $limit;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'userId' => $userId,
    ]);
    $favorites = $stmt->fetchAll();
  } catch (PDOException $e) {
    error_log("Erreur dans getFavorites : " . $e->getMessage());
  }
  return $favorites;
}

/**
 * Ajoute un jeu aux favoris d’un utilisateur.
 *
 * @param int $gameId - Identifiant du jeu à ajouter
 * @param int $userId - Identifiant de l'utilisateur
 * @return array - Résultat de l'opération avec succès et message en cas d'erreur
 */
function addFavorite($gameId, $userId)
{
  $gameId = (int)$gameId;
  $userId = (int)$userId;

  try {
    $pdo = connexionPDO();
    $sql = "INSERT INTO favorites(game_id, added_at, user_id) VALUES (:game_id, NOW(), :user_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'game_id' => $gameId,
      'user_id' => $userId
    ]);
    return [
      'success' => true,
      'message' => "Jeu ajouté aux favoris."
    ];
  } catch (PDOException $e) {
    $errorMsg = $e->getMessage();
    if (strpos($errorMsg, 'unique_user_game') !== false) {
      return [
        'success' => false,
        'message' => "Ce jeu est déjà dans vos favoris."
      ];
    }
    error_log("Erreur dans addFavorite : " . $errorMsg);
    return [
      'success' => false,
      'message' => "Erreur lors de l'ajout aux favoris."
    ];
  }
}





/**
 * Supprime un jeu favori d’un utilisateur.
 *
 * @param int $favoriteId - Identifiant du favori à supprimer
 * @return array - Résultat de l'opération avec succès et message en cas d'erreur
 */
function deleteFavorite($favoriteId)
{
  $favoriteId = (int)$favoriteId;

  try {
    $pdo = connexionPDO();
    $sql = "DELETE FROM favorites WHERE favorite_id = :favorite_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'favorite_id' => $favoriteId
    ]);
    return [
      'success' => true,
      'message' => "Jeu supprimé des favoris."
    ];
  } catch (PDOException $e) {
    error_log("Erreur dans deleteFavorite : " . $e->getMessage());
    return [
      'success' => false,
      'message' => "Erreur lors de la suppression du favori."
    ];
  }
}
