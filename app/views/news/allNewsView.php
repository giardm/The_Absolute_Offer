<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Liste complète des actualités.
  Affiche les news sous forme de grille, avec une miniature et un titre.
  ======================================================
-->

<div class="container" id="newsContainer">

  <!-- Grille responsive des actualités (affichage visuel CSS Grid) -->
  <div class="news-grid">
    <?php foreach ($news as $n): ?>
      <a href="?action=news&id=<?= $n['news_id'] ?>" class="news-item"
        aria-label="Lire l'article intitulé '<?= htmlspecialchars($n['title']) ?>'">
        <img src="<?= $n['thumb_path'] ?>" alt="<?= $n['thumb_alt'] ?>" class="thumb">
        <div class="overlay">
          <h3><?= mb_strimwidth($n['title'], 0, 35, '...') ?></h3>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Bouton d’ajout d'article visible uniquement par un administrateur -->
  <?php if (isAdmin()): ?>
    <a href="?action=addArticle" id="addArticle" aria-label="Ajouter un nouvel article d'actualité">Ajouter une News</a>
  <?php endif; ?>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>