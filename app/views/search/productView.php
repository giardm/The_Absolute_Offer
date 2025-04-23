<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Fiche produit (détail d’un jeu).
  Affiche les informations générales, offres, bande-annonce, captures, etc.
  ======================================================
-->

<!-- Animation de chargement avec logo vidéo -->
<div id="loaderContainer">
  <video id="loaderVideo" autoplay muted loop playsinline>
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
</div>

<!-- Conteneur principal du jeu, lié à son ID -->
<div class="container" data-id="<?= $gameId ?>">

  <!-- En-tête avec image de fond, jaquette, titre, boutons d’action -->
  <div class="productHeader">
    <div class="headerImageWrapper">
      <img class="headerImage" src="" alt="Bannière">
    </div>
    <div class="overlayContent">
      <img class="gameCover" src="<?= $afficheUrl ?>" alt="Affiche du jeu">
      <h2 class="gameTitle"></h2>
      <div class="buttons">
        <?php if (isAdmin()): ?>
          <button id="featuredOfferBtn" aria-label="Mettre le jeu en vedette">Mettre en vedette</button>
        <?php endif; ?>
        <?php if (isLoggedOn()): ?>
          <button id="favoriteBtn" aria-label="Ajouter le jeu aux favoris">Ajouter aux favoris</button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Bloc d'information sur le jeu (date, éditeur, etc.) -->
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

    <!-- Bloc des offres du jeu -->
    <div class="offers">
      <h3>Offres disponibles</h3>

      <!-- Liste principale des offres -->
      <ul class="offerList"></ul>

      <!-- Bouton d'ouverture de la modale (correction : suppression d’un class="hidden" en doublon) -->
      <button class="openOffersOverlay" data-game-id="<?= $gameId ?>" aria-label="Afficher toutes les offres pour ce jeu">Afficher toutes les offres</button>

      <!-- Modale contenant toutes les offres disponibles -->
      <div class="offersOverlay" data-game-id="<?= $gameId ?>" style="display: none;">
        <div class="overlayContent">
          <h3>Toutes les offres</h3>
          <button class="closeOffersOverlay" data-game-id="<?= $gameId ?>" aria-label="Fermer la fenêtre des offres">&times;</button>
          <ul class="offerList"></ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Description détaillée du jeu -->
  <h3 id="descriptionTitle">Description</h3>
  <div class="description"></div>

  <!-- Médias : bande-annonce et captures d'écran -->
  <div class="medias">
    <div class="videos">
      <h2>Bande-annonce</h2>
      <video controls aria-label="Bande-annonce du jeu">
        <source id="trailerSource" src="" type="video/webm">
      </video>
    </div>
    <div class="screenshots">
      <h2>Captures d'écran</h2>
      <div class="screenshotsGallery"></div>
    </div>
  </div>

  <!-- Note de droits et origine des données -->
  <p class="disclaimer">
    Les informations du jeu affichées sur cette page proviennent de
    <a target="_blank" href="https://store.steampowered.com/" aria-label="Ouvrir le site Steam dans un nouvel onglet">
      Steam (© Valve Corporation)
    </a>. Tous les noms, marques et images associés sont la propriété de leurs détenteurs respectifs.
    Ce site n'est ni affilié, ni approuvé par Valve Corporation.
  </p>
</div>

<!-- Modale Lightbox pour les captures d’écran -->
<div id="lightbox" class="lightbox hidden">
  <img id="lightboxImage" src="" alt="Capture d'écran en plein écran">
  <div class="lightbox-nav">
    <button id="prev" aria-label="Image précédente">&larr;</button>
    <button id="next" aria-label="Image suivante">&rarr;</button>
  </div>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>