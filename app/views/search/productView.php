<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div id="loaderContainer">
  <video id="loaderVideo" autoplay muted loop playsinline>
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
</div>
<div class=" container" data-id="<?= $gameId ?>">
  <div class="productHeader">
    <div class="headerImageWrapper">
      <img class="headerImage" src="" alt="Bannière">
    </div>
    <div class="overlayContent">
      <img class="gameCover" src="<?= $afficheUrl ?>" alt="Affiche du jeu">
      <div class="lowerOverlayContent"></div>
      <h2 class="gameTitle"></h2>
      <?php if (isAdmin()): ?>
        <button id="featureOfferBtn">Mettre en vedette</button>
        <div id="notification" class="hidden">Jeu ajouté à la page d'accueil !</div>
      <?php endif; ?>
      <?php if (isLoggedOn()): ?>
        <button id="favoriteBtn">Ajouter aux favoris</button>
        <div id="notification" class="hidden">Jeu ajouté a vos favoris !</div>
      <?php endif; ?>
    </div>
  </div>
  <div class="productMain">
    <div class="productInformations">
      <div class="informations">
        <ul>
          <h3>Informations</h3>
          <li><strong>Date de sortie :</strong> ...</li>
          <li><strong>Éditeur(s) :</strong> ...</li>
          <li><strong>Genres :</strong> ...</li>
          <li><strong>Score Metacritic :</strong> ...</li>
          <li><strong>Évaluations Steam :</strong> ...</li>
        </ul>
      </div>
    </div>
    <!-- OFFRES -->
    <div class="offers">
      <h3>Offres disponibles</h3>
      <!-- Offres visibles -->
      <ul class="offerList"></ul>
      <!-- Bouton pour ouvrir la modale -->
      <button class="openOffersOverlay" class="hidden" data-game-id="<?= $gameId  ?>">Afficher toutes les offres</button>
      <!-- Modale avec toutes les offres -->
      <div class="offersOverlay" data-game-id="<?= $gameId  ?>" style="display: none;">
        <div class="overlayContent">
          <h3>Toutes les offres</h3>
          <button class="closeOffersOverlay" data-game-id="<?= $gameId  ?>" aria-label="Fermer">&times;</button>
          <ul class="offerList"></ul>
        </div>
      </div>
    </div>
    <!-- FIN OFFRES -->
  </div>
  <h3 id="descriptionTitle">Description</h3>
  <div class="description"></div>
  <div class="medias">
    <div class="videos">
      <h2>Bande-annonce</h2>
      <video controls>
        <source id="trailerSource" src="" type="video/webm">
      </video>
    </div>
    <div class="screenshots">
      <h2>Captures d'écran</h2>
      <div class="screenshotsGallery"></div>
    </div>
  </div>
  <p class="disclaimer">Les informations du jeu affichées sur cette page proviennent de <a target="_blank" href="https://store.steampowered.com/">Steam (© Valve Corporation)</a>. Tous les noms, marques et images associés sont la propriété de leurs détenteurs respectifs. Ce site n'est ni affilié, ni approuvé par Valve Corporation.</p>
</div>
<!-- lightbox -->
<div id="lightbox" class="lightbox hidden">
  <img id="lightboxImage" src="" alt="Full Screenshot">
  <div class="lightbox-nav">
    <button id="prev">&larr;</button>
    <button id="next">&rarr;</button>
  </div>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>