<?php
require_once __DIR__ . '/../../config/config.php';

function getUserByUsername($username)
{
  $resultat = array();

  try {
    $cnx = connexionPDO();
    $req = $cnx->prepare("select * from users where username=:username");
    $req->bindValue(':username', $username, PDO::PARAM_STR);
    $req->execute();

    $resultat = $req->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    die();
  }
  return $resultat;
}
