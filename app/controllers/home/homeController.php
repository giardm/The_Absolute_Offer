<?php

require_once MODELS_PATH . '/featuredOffers.php';
require_once MODELS_PATH . '/newsModel.php';
require_once MODELS_PATH . '/favorites.php';

$featuredGames = getFeaturedOffers();
$news = getNews(6);
$favorites = getFavorites($_SESSION['user_id'], 3);

require VIEWS_PATH . '/core/homeView.php';
