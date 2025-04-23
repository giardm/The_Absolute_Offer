<?php

/**
 * ======================================================
 * Initialise et retourne une connexion sécurisée à la base de données.
 * Utilise PDO avec gestion des erreurs et encodage UTF-8.
 * ======================================================
 */

require_once BASE_PATH . '/config/config.php';

/**
 * Crée et retourne une instance PDO pour la connexion à la base de données.
 *
 * @return PDO - Instance de connexion à la base de données
 */
function connexionPDO()
{
  return new PDO(
    // Chaîne de connexion avec hôte, nom de la base, et encodage
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",

    // Identifiants définis dans le fichier de configuration
    DB_USER,
    DB_PASS,

    // Options de PDO : erreurs levées en exception + fetch associatif par défaut
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
}
