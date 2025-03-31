<?Php
require_once VIEWS_PATH . ('/productView.php'); // $steamData est accessible dans la vue
?>
<?php if ($gameData && $steamData): ?>
  <?php
  $steamAppID = $gameData['info']['steamAppID'];
  $afficheUrl = "https://cdn.akamai.steamstatic.com/steam/apps/{$steamAppID}/library_600x900.jpg";
  ?>

  <h1><?= htmlspecialchars($steamData['name']) ?></h1>

  <img src="<?= $afficheUrl ?>" alt="Affiche de <?= $steamData['name'] ?>" style="max-width: 300px; border-radius: 12px;" />

  <p><strong>Meilleur prix :</strong> <?= $gameData['deals'][0]['price'] ?> €</p>

  <p><strong>Date de sortie :</strong> <?= $steamData['release_date']['date'] ?></p>

  <p><strong>Éditeur(s) :</strong> <?= implode(', ', $steamData['publishers']) ?></p>

  <p><strong>Genres :</strong>
    <?= implode(', ', array_map(fn($g) => $g['description'], $steamData['genres'])) ?>
  </p>

  <p><?= $steamData['short_description'] ?></p>

  <?php if (!empty($steamData['metacritic'])): ?>
    <p><strong>Score Metacritic :</strong> <?= $steamData['metacritic']['score'] ?>/100</p>
  <?php endif; ?>

  <?php if (!empty($steamData['recommendations'])): ?>
    <p><strong>Évaluations Steam :</strong> <?= number_format($steamData['recommendations']['total']) ?> avis</p>
  <?php endif; ?>

  <?php if (!empty($steamData['movies'])): ?>
    <h2>Bande-annonce</h2>
    <video controls style="max-width: 100%; border-radius: 8px;">
      <source src="<?= $steamData['movies'][0]['webm']['max'] ?>" type="video/webm">
      Votre navigateur ne supporte pas la vidéo.
    </video>
  <?php endif; ?>

  <?php if (!empty($steamData['screenshots'])): ?>
    <h2>Captures d'écran</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
      <?php foreach ($steamData['screenshots'] as $shot): ?>
        <img src="<?= $shot['path_thumbnail'] ?>" alt="Screenshot" style="max-width: 200px; border-radius: 8px;">
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

<?php else: ?>
  <p>Impossible de récupérer les informations du jeu.</p>
<?php endif; ?>