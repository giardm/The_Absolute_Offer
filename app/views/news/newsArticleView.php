<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Affichage d'un article de news.
  Affiche le titre, la catégorie, le contenu, et les infos de publication.
  Si aucun article n’est trouvé, affiche un message d’erreur.
  ======================================================
-->

<div class="container">
  <?php if (!empty($article)) : ?>
    <article class="newsArticle" id="newsArticle<?= $article['news_id'] ?>">

      <!-- Miniature de l'article -->
      <div class="newsThumbnailWrapper">
        <img
          src="<?= $article['thumb_path'] ?>"
          alt="<?= $article['thumb_alt'] ?>"
          class="newsThumbnail">
      </div>

      <!-- Titre principal de l’article -->
      <h1 class="newsTitle"><?= htmlspecialchars($article['title']) ?></h1>

      <!-- Catégorie associée -->
      <h4 class="category"><?= htmlspecialchars($article['category_name']) ?></h4>

      <!-- Contenu HTML de l’article (rendu tel quel) -->
      <div class="newsContent">
        <?= $article['content'] ?>
      </div>

      <!-- Signature de l’auteur et date de publication -->
      <footer class="newsFooter">
        <span class="newsAuthor">Écrit par <strong><?= htmlspecialchars($article['username']) ?></strong></span>
        <span class="newsDate">le <?= date('F j, Y', strtotime($article['added_at'])) ?></span>
      </footer>

    </article>
  <?php else : ?>
    <!-- Message affiché si l’article n’existe pas -->
    <p class="newsNotFound">Désolé, cette page n'existe pas.</p>
  <?php endif; ?>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>