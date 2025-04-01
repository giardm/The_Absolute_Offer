<?php
require_once VIEWS_PATH . ('/productView.php');
require_once MODELS_PATH . ('/getStoreList.php');

$steamAppID = $gameData['info']['steamAppID'] ?? null;
$cheapsharkTitle = $gameData['info']['title'] ?? 'Titre non disponible';
$cheapsharkPrice = $gameData['deals'][0]['price'] ?? 'N/A';
$afficheUrl = $steamAppID
  ? "https://cdn.akamai.steamstatic.com/steam/apps/{$steamAppID}/library_600x900.jpg"
  : $gameData['info']['thumb'];
?>
<div class="productContainer">
  <div class="productHeader">
    <div class="headerImageWrapper">
      <img class="headerImage" src="<?= $steamData['header_image'] ?? $gameData['info']['thumb'] ?>" alt="Bannière">
    </div>
    <div class="overlayContent">
      <img class="gameCover" src="<?= $afficheUrl ?>" alt="Affiche du jeu">
      <h2 class="gameTitle"><?= htmlspecialchars($cheapsharkTitle) ?></h2>
    </div>
  </div>

  <div class="productMain">
    <div class="productInformations">
      <div class="informations">
        <ul>
          <h3>Informations</h3>
          <li><strong>Meilleur prix jamais enregistré :</strong> <?= $cheapsharkPrice ?> €</li>
          <?php if (!empty($steamData)): ?>
            <li><strong>Date de sortie :</strong> <?= $steamData['release_date']['date'] ?? '' ?></li>
            <li><strong>Éditeur(s) :</strong> <?= implode(', ', $steamData['publishers']) ?></li>
            <li><strong>Genres :</strong>
              <?= implode(', ', array_map(fn($g) => $g['description'], $steamData['genres'])) ?>
            </li>
            <?php if (!empty($steamData['metacritic'])): ?>
              <li><strong>Score Metacritic :</strong> <?= $steamData['metacritic']['score'] ?>/100</li>
            <?php endif; ?>
            <?php if (!empty($steamData['recommendations'])): ?>
              <li><strong>Évaluations Steam :</strong> <?= number_format($steamData['recommendations']['total']) ?> avis</li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </div>
      <div class="offers">
        <h3>Offres disponibles</h3>
        <ul class="offerList">
          <?php foreach ($gameData['deals'] as $deal): ?>
            <?php
            $storeID = (int)$deal['storeID']; // <-- Corrigé ici
            $store = $storeMap[$storeID] ?? ['name' => 'Store inconnu', 'logo' => ''];
            $savings = round($deal['savings']);
            $dealUrl = "https://www.cheapshark.com/redirect?dealID={$deal['dealID']}";
            ?>
            <li class="offerItem">
              <a class="offerCard" href="<?= $dealUrl ?>" target="_blank">
                <?php if ($store['logo']): ?>
                  <img class="storeLogo" src="<?= $store['logo'] ?>" alt="<?= $store['name'] ?>">
                <?php endif; ?>
                <div class="offerInfo">
                  <p class="storeName"><?= $store['name'] ?></p>
                  <p class="prices">
                    <span class="price"><?= $deal['price'] ?> €</span>
                    <span class="retailPrice"><?= $deal['retailPrice'] ?> €</span>
                  </p>
                  <span class="discount">-<?= $savings ?>%</span>
                </div>
              </a>
            </li>
          <?php endforeach; ?>

        </ul>

      </div>
    </div>

    <?php if (!empty($steamData['about_the_game'])): ?>
      <h3>Description</h3>
      <div class="description">
        <?= $steamData['about_the_game'] ?>
      </div>
    <?php endif; ?>

    <div class="medias">
      <?php if (!empty($steamData['movies'])): ?>
        <div class="videos">
          <h2>Bande-annonce</h2>
          <video controls>
            <?php
            $videoUrl = $steamData['movies'][0]['webm']['max'];
            $secureVideoUrl = preg_replace('/^http:/', 'https:', $videoUrl);
            ?>
            <source src="<?= $secureVideoUrl ?>" type="video/webm">
          </video>
        </div>
      <?php endif; ?>

      <?php if (!empty($steamData['screenshots'])): ?>
        <div class="screenshots">
          <h2>Captures d'écran</h2>
          <div class="screenshotsGallery">
            <?php foreach ($steamData['screenshots'] as $index => $shot): ?>
              <img
                src="<?= $shot['path_thumbnail'] ?>"
                data-full="<?= $shot['path_full'] ?>"
                data-index="<?= $index ?>"
                class="screenshotThumb"
                alt="Screenshot">
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
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