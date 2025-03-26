<?php

class home_ctlr
{
  public function index()
  {
    // Charger la vue pour la page d'accueil
    require_once __DIR__ . '/../views/home.php';
  }
}
