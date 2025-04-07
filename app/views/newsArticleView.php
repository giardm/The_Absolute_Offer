<?php if (!empty($article)) : ?>
  <article class="newsArticle" id="newsArticle<?= $article['news_id'] ?>">

    <!-- Thumbnail -->
    <div class="newsThumbnailWrapper">
      <img
        src=".<?= htmlspecialchars($article['thumb']) ?>"
        alt="<?= htmlspecialchars($article['thumb_alt']) ?>"
        class="newsThumbnail">
    </div>

    <!-- Title -->
    <h1 class="newsTitle"><?= htmlspecialchars($article['title']) ?></h1>

    <!-- Content -->
    <div class="newsContent">
      <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
    </div>

    <!-- Signature -->
    <footer class="newsFooter">
      <span class="newsAuthor">Written by <strong><?= htmlspecialchars($article['username']) ?></strong></span>
      <span class="newsDate">on <?= date('F j, Y', strtotime($article['added_at'])) ?></span>
    </footer>

  </article>
<?php else : ?>
  <p class="newsNotFound">Désolé, cette page n'existe pas.</p>
<?php endif;  ?>