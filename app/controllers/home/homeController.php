<?php

require_once MODELS_PATH . '/featuredOffers.php';
require_once MODELS_PATH . '/newsModel.php';

$featuredGames = getFeaturedOffers();
$news = getNews();

require VIEWS_PATH . "/partials/headerView.php";

require VIEWS_PATH . '/homeView.php';

require VIEWS_PATH . "/partials/footerView.php";
