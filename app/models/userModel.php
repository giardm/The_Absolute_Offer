<?php

require_once MODELS_PATH . '/connexionDB.php';


function createUser($email, $username, $hashedPassword)
{
  try {
    $pdo = connexionPDO();
    $sql = "
        SELECT user_id FROM users WHERE email = :email
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'email' => $email,
    ]);
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }

  $role = 'user'; //role user par défaut
  $now = date('Y-m-d H:i:s');

  try {
    $pdo = connexionPDO();
    $insert = "INSERT INTO users (email, username, hash_password, role, added_at)
    VALUES (:email, :username, :password, :role, :created_at)";
    $stmt = $pdo->prepare($insert);
    return $stmt->execute([
      'email' => $email,
      'username' => $username,
      'password' => $hashedPassword,
      'role' => $role,
      'created_at' => $now
    ]);
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
  }
}

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

    if ($user && isset($user['added_at'])) {
      $registrationDate = new DateTime($user['added_at']);
      $now = new DateTime();
      $diffInSeconds = $now->getTimestamp() - $registrationDate->getTimestamp();
      $user['added_at'] = formatDurationFromSeconds($diffInSeconds);
    }

    return $user;
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    return false;
  }
}


function isLoggedOn()
{
  return isset($_SESSION['username']);
}

function isAdmin()
{
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


function logout()
{
  if (isset($_SESSION)) {
    $_SESSION = [];
  };

  session_destroy();
}


// Fonction pour formater la durée
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
