<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<?php if (!empty($article)) : ?>
  <article class="newsArticle" id="newsArticle<?= $article['news_id'] ?>">

    <!-- Thumbnail -->
    <div class="newsThumbnailWrapper">
      <img
        src="<?= $article['thumb_path'] ?>" alt="<?= $article['thumb_alt'] ?>"
        class="newsThumbnail">
    </div>

    <!-- Title -->
    <h1 class="newsTitle"><?= htmlspecialchars($article['title']) ?></h1>

    <!-- Content -->
    <div class="newsContent">
      <?= $article['content'] ?>
    </div>

    <!-- Signature -->
    <footer class="newsFooter">
      <span class="newsAuthor">Ecrit par <strong><?= htmlspecialchars($article['username']) ?></strong></span>
      <span class="newsDate">le <?= date('F j, Y', strtotime($article['added_at'])) ?></span>
    </footer>

  </article>
<?php else : ?>
  <p class="newsNotFound">Désolé, cette page n'existe pas.</p>
<?php endif;  ?>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>