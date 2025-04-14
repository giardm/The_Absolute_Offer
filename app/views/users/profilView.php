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
    <div class="favoritesWrapper">
      <?php foreach ($favorites as $favorite): ?>
        <div class="favoriteCard" data-game-id="<?= $favorite['game_id'] ?>">
          <a href="?action=product&id=<?= $favorite['game_id'] ?>" class="favoriteLink">
            <div class="imageWrapper">
              <img src="" alt="Chargement..." class="gameImage skeleton" />
            </div>
            <div class="hoverOverlay">
              <span class="viewOffersButton">Voir les offres</span>
            </div>
          </a>
          <p class="gameTitle skeleton">Chargement...</p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>