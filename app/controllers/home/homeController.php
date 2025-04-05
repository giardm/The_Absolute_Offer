<?php

require_once MODELS_PATH . '/featuredOffers.php';

$featuredGames = getFeaturedOffers();

require VIEWS_PATH . "/partials/headerView.php";

require VIEWS_PATH . '/homeView.php';

require VIEWS_PATH . "/partials/footerView.php";
