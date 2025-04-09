<?php

require_once MODELS_PATH . '/featuredOffers.php';
require_once MODELS_PATH . '/newsModel.php';

$featuredGames = getFeaturedOffers();
$news = getNews(6);

require VIEWS_PATH . '/core/homeView.php';
