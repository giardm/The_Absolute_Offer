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
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    return false;
  }
}




function isLoggedOn()
{
  return isset($_SESSION['user']);
}

function getLoggedUser()
{
  return $_SESSION['user'] ?? null;
}
