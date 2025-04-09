<?php
require_once MODELS_PATH . '/newsModel.php';

$id = $_GET['id'] ?? null;

if ($id && ctype_digit($id)) {
  $article = getArticleById($id);

  require_once VIEWS_PATH . '/news/newsArticleView.php';
} else {

  $news = getNews(20);

  require_once VIEWS_PATH . '/news/allNewsView.php';
}
