<?php

if (session_status() === PHP_SESSION_NONE) {
  session_name("<the_absolute_offer>");
  session_start();
}

require(__DIR__ . '/config/config.php');

require_once MODELS_PATH . '/featuredOffers.php';

$featuredGames = getFeaturedOffers();

if (isset($_GET["action"])) {
  $action = $_GET["action"];
} else {
  $action = "home";
}


require CONTROLLERS_PATH . "/core/router.php";
