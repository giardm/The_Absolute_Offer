<?php
require_once MODELS_PATH . '/newsModel.php';
require_once MODELS_PATH . '/newsModel.php';

$id = $_GET['id'] ?? null;

if ($id && ctype_digit($id)) {
  $article = getArticleById($id);
} else {
  require_once CONTROLLERS_PATH . '/home/homeController.php';
}

require_once VIEWS_PATH . '/partials/headerView.php';
require_once VIEWS_PATH . '/newsArticleView.php';
require_once VIEWS_PATH . '/partials/footerView.php';
