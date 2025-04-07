<?php
require_once MODELS_PATH . '/connexionDB.php';

function getUserByUsername($username)
{
  $resultat = array();

  try {
    $cnx = connexionPDO();
    $req = $cnx->prepare("select * from users where username=:username");
    $req->bindValue(':username', $username, PDO::PARAM_STR);
    $req->execute();

    return $req->fetch();
  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    die();
  }
  return $resultat;
}
