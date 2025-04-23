<?php

/**
 * ======================================================
 * Gère les opérations liées aux utilisateurs :
 * création, authentification, session, suppression, et affichage de l’ancienneté.
 * ======================================================
 */

require_once MODELS_PATH . '/connexionDb.php';

/**
 * Crée un nouvel utilisateur dans la base de données.
 *
 * @param string $email - Adresse email de l'utilisateur
 * @param string $username - Nom d'utilisateur
 * @param string $hashedPassword - Mot de passe déjà haché
 * @return array - Résultat de l'opération avec message
 */
function createUser($email, $username, $hashedPassword)
{
  $role = 'user';
  $now = date('Y-m-d H:i:s');

  try {
    $pdo = connexionPDO();

    $insert = "INSERT INTO users (email, username, hash_password, role, added_at)
               VALUES (:email, :username, :password, :role, :created_at)";
    $stmt = $pdo->prepare($insert);

    // Insertion de l'utilisateur avec ses informations
    $stmt->execute([
      'email' => $email,
      'username' => $username,
      'password' => $hashedPassword,
      'role' => $role,
      'created_at' => $now
    ]);

    return [
      'success' => true,
      'message' => "Inscription réussie."
    ];
  } catch (PDOException $e) {
    // Gestion des erreurs liées aux champs uniques
    if ($e->getCode() == 23000) {
      $message = $e->getMessage();
      if (strpos($message, 'email') !== false) {
        return [
          'success' => false,
          'message' => "Cette adresse email est déjà utilisée."
        ];
      } elseif (strpos($message, 'username') !== false) {
        return [
          'success' => false,
          'message' => "Ce nom d'utilisateur est déjà utilisé."
        ];
      } else {
        return [
          'success' => false,
          'message' => "Un champ unique est déjà utilisé."
        ];
      }
    } else {
      error_log("Erreur SQL dans createUser : " . $e->getMessage());
      return [
        'success' => false,
        'message' => "Une erreur est survenue lors de l'inscription."
      ];
    }
  }
}

/**
 * Récupère un utilisateur à partir de son email ou nom d'utilisateur.
 *
 * @param string $identifier - Email ou nom d'utilisateur
 * @return array|false - Utilisateur trouvé ou false
 */
function getUserByEmailOrUsername($identifier)
{
  try {
    $pdo = connexionPDO();
    $sql = "SELECT * FROM users WHERE email = :email OR username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'email' => $identifier,
      'username' => $identifier
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ajout d'une durée lisible depuis l'inscription
    if ($user && isset($user['added_at'])) {
      $registrationDate = new DateTime($user['added_at']);
      $now = new DateTime();
      $diffInSeconds = $now->getTimestamp() - $registrationDate->getTimestamp();
      $user['added_at'] = formatDurationFromSeconds($diffInSeconds);
    }

    return $user;
  } catch (PDOException $e) {
    error_log("Erreur dans getUserByEmailOrUsername : " . $e->getMessage());
    return false;
  }
}

/**
 * Vérifie si un utilisateur est actuellement connecté.
 *
 * @return bool - true si connecté, false sinon
 */
function isLoggedOn()
{
  return isset($_SESSION['username']);
}

/**
 * Vérifie si l'utilisateur connecté a le rôle administrateur.
 *
 * @return bool - true si admin, false sinon
 */
function isAdmin()
{
  return isset($_SESSION['tao_role']) && $_SESSION['tao_role'] === 'admin';
}

/**
 * Déconnecte proprement l'utilisateur.
 *
 * @return void
 */
function logout()
{
  // Vide toutes les variables de session
  $_SESSION = [];
  session_unset();

  // Supprime le cookie de session si existant
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }

  // Détruit la session
  session_destroy();
}

/**
 * Formate une durée exprimée en secondes en texte lisible.
 *
 * @param int $seconds - Durée en secondes
 * @return string - Texte représentant la durée
 */
function formatDurationFromSeconds(int $seconds): string
{
  if ($seconds < 60) {
    return "Moins d'une minute";
  } elseif ($seconds < 3600) {
    $minutes = floor($seconds / 60);
    return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
  } elseif ($seconds < 86400) {
    $hours = floor($seconds / 3600);
    return $hours . ' heure' . ($hours > 1 ? 's' : '');
  } elseif ($seconds < 2592000) {
    $days = floor($seconds / 86400);
    return $days . ' jour' . ($days > 1 ? 's' : '');
  } elseif ($seconds < 31536000) {
    $months = floor($seconds / 2592000);
    return $months . ' mois';
  } else {
    $years = floor($seconds / 31536000);
    return $years . ' an' . ($years > 1 ? 's' : '');
  }
}

/**
 * Supprime définitivement un compte utilisateur.
 *
 * @param int $userId - Identifiant de l'utilisateur à supprimer
 * @return array - Résultat de l'opération avec message
 */
function deleteAccount($userId)
{
  $userId = (int)$userId;

  try {
    $pdo = connexionPDO();
    $sql = "DELETE FROM users WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'user_id' => $userId
    ]);
    return [
      'success' => true,
      'message' => "Compte utilisateur supprimé avec succès."
    ];
  } catch (PDOException $e) {
    error_log("Erreur dans deleteAccount : " . $e->getMessage());
    return [
      'success' => false,
      'message' => "Erreur lors de la suppression du compte."
    ];
  }
}
