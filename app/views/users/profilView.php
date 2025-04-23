<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Page de profil utilisateur.
  Affiche les informations de compte et les jeux favoris.
  ======================================================
-->

<div class="profileContainer">

  <!-- Section : Informations utilisateur -->
  <section class="profileSection">
    <h2 class="sectionTitle">Mon profil</h2>

    <div class="profileInfo">
      <p><strong>Pseudo :</strong> <?= $user['username'] ?></p>
      <p><strong>Email :</strong> <?= $user['email'] ?></p>
      <p><strong>Membre depuis :</strong> <?= $user['added_at'] ?></p>
    </div>

    <!-- Bouton de déconnexion -->
    <div class="logoutWrapper">
      <a href="?action=logout" class="logoutButton" aria-label="Se déconnecter de votre compte">Déconnexion</a>
    </div>
  </section>

  <!-- Section : Liste des jeux favoris -->
  <section id="favoritesSection">
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
              <button
                class="deleteButton"
                data-favorite-id="<?= $favorite['favorite_id'] ?>"
                aria-label="Supprimer ce jeu des favoris">
                Supprimer
              </button>
            </div>
            <p class="gameTitle">Chargement...</p>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Modales contenant toutes les offres pour chaque jeu -->
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

      <!-- Bouton pour activer le mode suppression -->
      <div class="deleteModeWrapper">
        <button id="toggleDeleteMode" class="deleteModeButton" aria-label="Activer le mode suppression des favoris">
          Supprimer un jeu
        </button>
      </div>
    <?php endif; ?>
  </section>

</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>