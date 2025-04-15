<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div class="profileContainer">
  <section class="profileSection">
    <h2 class="sectionTitle">Mon profil</h2>
    <div class="profileInfo">
      <p><strong>Pseudo :</strong> <?= $user['username'] ?></p>
      <p><strong>Email :</strong> <?= $user['email'] ?></p>
      <p><strong>Membre depuis :</strong> <?= $user['added_at'] ?></p>
    </div>
    <div class="logoutWrapper">
      <a href="?action=logout" class="logoutButton">Déconnexion</a>
    </div>
  </section>

  <section class="favoritesSection">
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
              <button class="deleteButton" data-favorite-id="<?= $favorite['favorite_id'] ?>">Supprimer</button>
            </div>
            <p class="gameTitle">Chargement...</p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="offers">
        <!-- Modale avec toutes les offres -->
        <div class="offersOverlay" style="display: none;">
          <div class="overlayContent">
            <h3>Toutes les offres</h3>
            <button class="closeOffersOverlay" aria-label="Fermer">&times;</button>
            <ul class="offerList"></ul>
          </div>
        </div>
      </div>

      <div class="deleteModeWrapper">
        <button id="toggleDeleteMode" class="deleteModeButton">Supprimer un jeu</button>
      </div>
    <?php endif; ?>
  </section>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>