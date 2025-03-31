<?Php
require_once VIEWS_PATH . ('/productView.php'); // $steamData est accessible dans la vue
?>
<?php if ($gameData && $steamData): ?>
  <?php
  $steamAppID = $gameData['info']['steamAppID'];
  $afficheUrl = "https://cdn.akamai.steamstatic.com/steam/apps/{$steamAppID}/library_600x900.jpg";
  ?>
  <div class="productHeader" style="background-image: url(<?= $steamData['header_image'] ?>);">
    <img class="gameCover" src="<?= $afficheUrl ?>" alt="Affiche de <?= $steamData['name'] ?>" style="max-width: 300px; border-radius: 12px;" />
    <h2 class="gameTitle"><?= $steamData['name'] ?></h2>
  </div>

  <ul>
    <li><strong>Date de sortie :</strong> <?= $steamData['release_date']['date'] ?></li>
    <li><strong>Éditeur(s) :</strong> <?= implode(', ', $steamData['publishers']) ?></li>
    <li><strong>Genres :</strong>
      <?= implode(', ', array_map(fn($g) => $g['description'], $steamData['genres'])) ?></li>
    <li> <?php if (!empty($steamData['metacritic'])): ?>
        <p><strong>Score Metacritic :</strong> <?= $steamData['metacritic']['score'] ?>/100</p>
      <?php endif; ?>
    </li>
    <li>
      <?php if (!empty($steamData['recommendations'])): ?>
        <p><strong>Évaluations Steam :</strong> <?= number_format($steamData['recommendations']['total']) ?> avis</p>
      <?php endif; ?>
    </li>
  </ul>

  <h3>Informations</h3>
  <div class="description">
    <?= $steamData['about_the_game'] ?>
  </div>


  <div class="medias">
    <div class="videos">
      <?php if (!empty($steamData['movies'])): ?>
        <h2>Bande-annonce</h2>
        <video controls style="max-width: 100%; border-radius: 8px;">
          <?php
          $videoUrl = $steamData['movies'][0]['webm']['max'];
          $secureVideoUrl = preg_replace('/^http:/', 'https:', $videoUrl);
          ?>
          <source src="<?= $secureVideoUrl ?>" type="video/webm">
          Votre navigateur ne supporte pas la vidéo.
        </video>
      <?php endif; ?>
    </div>
    <div class="screenshots">
      <?php if (!empty($steamData['screenshots'])): ?>
        <h2>Captures d'écran</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
          <?php foreach ($steamData['screenshots'] as $shot): ?>
            <img src="<?= $shot['path_thumbnail'] ?>" alt="Screenshot" style="max-width: 200px; border-radius: 8px;">
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

<?php else: ?>
  <p>Impossible de récupérer les informations du jeu.</p>
<?php endif; ?>