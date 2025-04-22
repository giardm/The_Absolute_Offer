<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div class="container" id="newsContainer">
  <!-- css grid -->
  <div class="news-grid">
    <?php foreach ($news as $n): ?>
      <a href="?action=news&id=<?= $n['news_id'] ?>" class="news-item">
        <img src="<?= $n['thumb_path'] ?>" alt="<?= $n['thumb_alt'] ?>" class="thumb">
        <div class="overlay">
          <h3><?= mb_strimwidth($n['title'], 0, 35, '...') ?></h3>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
  <?php if (isAdmin()): ?>
    <a href="?action=addArticle" id="addArticle">Ajouter une News</a>
  <?php endif; ?>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>