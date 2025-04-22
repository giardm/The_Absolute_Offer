<?php


require_once MODELS_PATH . '/newsModel.php';
require_once MODELS_PATH . '/favorites.php';
require_once MODELS_PATH . '/userModel.php';


$news = getNews(6);
if (isLoggedOn()) {
  $favorites = getFavorites($_SESSION['user_id'], 3);
}

require VIEWS_PATH . '/core/homeView.php';
