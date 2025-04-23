<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!-- ======================================================
     Section d’introduction avec vidéo et slogan principal
     ====================================================== -->
<div class="container" id="homeHero">
  <video autoplay loop muted playsinline aria-hidden="true">
    <!-- Source vidéo MP4 commentée -->
    <!-- <source src="./public/videos/logo.mp4" type="video/mp4"> -->
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
  <h1>The Absolute Offer</h1>
  <p>Vos jeux préférés aux prix que vous voulez</p>
</div>

<!-- ======================================================
     Section des offres en vedette (slider horizontal)
     ====================================================== -->
<div class="container" id="homeFeaturedOffers">
  <h2 class="sectionTitle">Jeux du moment</h2>
  <div id="featuredGamesContainer">
    <div class="sliderContainer">
      <div class="sliderWrapper">
        <?php foreach ($featuredGames as $game): ?>
          <div class="slide">
            <a href="?action=product&id=<?= $apiId = $game['api_id']; ?>" aria-label="Consulter la page de <?= htmlspecialchars($game['game_title']) ?>">
              <img src="<?= $game['img_path'] ?>" alt="<?= $game['game_title'] ?>" loading="lazy">
            </a>
            <p class="gameTitle"><?= $game['game_title'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- ======================================================
     Section des actualités affichées en grille (news)
     ====================================================== -->
<div class="container" id="newsContainer">
  <div class="horizontalLine"></div>
  <a href="?action=news">
    <h2 class="sectionTitle">News</h2>
  </a>

  <div class="news-grid">
    <?php foreach ($news as $n): ?>
      <a href="?action=news&id=<?= $n['news_id'] ?>" class="news-item" aria-label="Lire l'article intitulé '<?= htmlspecialchars($n['title']) ?>'">
        <img src="<?= $n['thumb_path'] ?>" alt="<?= $n['thumb_alt'] ?>" class="thumb">
        <div class="overlay">
          <h3><?= mb_strimwidth($n['title'], 0, 35, '...') ?></h3>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Lien vers l'ajout d'une news visible uniquement par un administrateur -->
  <?php if (isAdmin()): ?>
    <a href="?action=addArticle" id="addArticle">Ajouter une News</a>
  <?php endif; ?>
</div>

<!-- ======================================================
     Section des favoris de l'utilisateur connecté
     ====================================================== -->
<?php if (isLoggedOn()) : ?>
  <section class="container" id="favoritesSection">
    <div class="horizontalLine"></div>
    <h2 class="sectionTitle">Mes favoris</h2>

    <?php if (empty($favorites)): ?>
      <p class="noFavorites">Vous n'avez aucun jeu en favoris.</p>
    <?php else: ?>
      <div class="favoritesWrapper">
        <?php foreach ($favorites as $favorite): ?>
          <div class="favoriteCard openOffersOverlay" data-game-id="<?= $favorite['game_id'] ?>">
            <div class="imageWrapper">
              <img src="" alt="Chargement..." class="gameImage" />
            </div>
            <div class="hoverOverlay">
              <!-- Bouton de suppression avec accessibilité -->
              <button class="deleteButton" data-favorite-id="<?= $favorite['favorite_id'] ?>" aria-label="Supprimer ce jeu des favoris">Supprimer</button>
            </div>
            <p class="gameTitle">Chargement...</p>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Modales affichant les offres associées à chaque jeu favori -->
      <?php foreach ($favorites as $favorite): ?>
        <div class="offers">
          <div class="offersOverlay" data-game-id="<?= $favorite['game_id'] ?>" style="display: none;">
            <div class="overlayContent">
              <h3>Toutes les offres</h3>
              <button class="closeOffersOverlay" aria-label="Fermer la fenêtre des offres">&times;</button>
              <ul class="offerList"></ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
<?php endif; ?>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>