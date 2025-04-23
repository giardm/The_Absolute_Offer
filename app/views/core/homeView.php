<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!-- ======================================================
     Section d’introduction avec vidéo et slogan principal
     ====================================================== -->
<div class="container" id="homeHero">
  <svg id="heroLogo" alt="Logo TAO version bureau" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 525.47 256.65">
    <path class="cls-1" d="M135.06,59.63h-35.27c0,18.43-14.99,33.43-33.43,33.43v35.27c37.94,0,68.7-30.76,68.7-68.7Z" />
    <path class="cls-1" d="M168.48,197.03v-35.27c-18.43,0-33.43-14.99-33.43-33.43h-35.27c0,37.94,30.76,68.7,68.7,68.7Z" />
    <rect class="cls-1" x="135.06" y="93.05" width="35.27" height="35.27" />
    <path class="cls-1" d="M393.13,59.63c-37.94,0-68.7,30.76-68.7,68.7s30.76,68.7,68.7,68.7,68.7-30.76,68.7-68.7-30.76-68.7-68.7-68.7ZM393.13,161.75c-18.43,0-33.43-14.99-33.43-33.43s14.99-33.43,33.43-33.43,33.43,14.99,33.43,33.43-14.99,33.43-33.43,33.43Z" />
    <path class="cls-1" d="M397.15,0H128.33C57.57,0,0,57.57,0,128.33s57.57,128.33,128.33,128.33h268.82c70.76,0,128.33-57.57,128.33-128.33S467.91,0,397.15,0ZM397.15,221.38H128.33c-51.31,0-93.05-41.74-93.05-93.05s41.74-93.05,93.05-93.05h268.82c51.31,0,93.05,41.74,93.05,93.05s-41.74,93.05-93.05,93.05Z" />
    <path class="cls-1" d="M233.07,161.75h0c-9.74,0-17.64,7.9-17.64,17.64s7.9,17.64,17.64,17.64h0c9.74,0,17.64-7.9,17.64-17.64s-7.9-17.64-17.64-17.64Z" />
    <path class="cls-1" d="M283.11,128.33v-35.27h-60.81c0,18.43-14.99,33.43-33.43,33.43v35.27c25.05,0,46.96-13.41,58.96-33.44v.02c0,37.94,30.76,68.7,68.7,68.7v-35.27c-18.43,0-33.43-14.99-33.43-33.43Z" />
  </svg>
  <video id="heroVideo" autoplay loop muted playsinline aria-hidden="true">
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