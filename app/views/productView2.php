<div class="productContainer" data-id="<?= $gameId ?>">
  <div class="productHeader">
    <div class="headerImageWrapper">
      <img class="headerImage" src="" alt="Bannière">
    </div>
    <div class="overlayContent">
      <img class="gameCover" src="<?= $afficheUrl ?>" alt="Affiche du jeu">
      <h2 class="gameTitle"></h2>
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
      <button id="openOffersOverlay" class="hidden">Afficher toutes les offres</button>
      <!-- Modale avec toutes les offres -->
      <div id="offersOverlay" style="display: none;">
        <div class="overlayContent">
          <h3>Toutes les offres</h3>
          <button id="closeOffersOverlay" aria-label="Fermer">&times;</button>
          <ul class="offerList"></ul>
        </div>
      </div>
    </div>
    <!-- FIN OFFRES -->
  </div>
  <h3>Description</h3>
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
</div>
<!-- lightbox -->
<div id="lightbox" class="lightbox hidden">
  <img id="lightboxImage" src="" alt="Full Screenshot">
  <div class="lightbox-nav">
    <button id="prev">&larr;</button>
    <button id="next">&rarr;</button>
  </div>
</div>