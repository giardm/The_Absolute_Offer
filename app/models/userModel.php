<?php
// app/models/userModel.php
require_once __DIR__ . '/../../config/config.php';


function createUser($email, $username, $hashedPassword) {
    $role='user'; //role user par défaut
    $now = date('Y-m-d H:i:s'); 

    // Vérifier si l'utilisateur existe déjà
    $pdo = connexionPDO();
    $query = "SELECT user_id FROM users WHERE email = :email OR username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $email,
        'username' => $username
    ]);

    if ($stmt->fetch()) {
        return false; // utilisateur déjà existant
    }

    // Insérer le nouvel utilisateur
    $insert = "INSERT INTO users (email, username, hash_password, role, created_at)
    VALUES (:email, :username, :password, :role, :created_at)";
    $stmt = $pdo->prepare($insert);
    return $stmt->execute([
    'email' => $email,
    'username' => $username,
    'password' => $hashedPassword,
    'role' => $role,
    'created_at' => $now
]);

}

function getUserByEmailOrUsername($identifier) {
    $pdo = connexionPDO();
    $sql = "SELECT * FROM users WHERE email = :email OR username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email' => $identifier,
        'username' => $identifier
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


