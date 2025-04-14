<?php require VIEWS_PATH . "/partials/headerView.php"; ?>
<div class="container" id="homeHero">
  <video autoplay loop muted playsinline>
    <!-- <source src="./videos/logo.mp4" type="video/mp4"> -->
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
  <h1>The Absolute Offer</h1>
  <p>Vos jeux préférés aux prix que vous voulez</p>
</div>

<div class="container" id="homeFeaturedOffers">
  <h2 class="sectionTitle">Jeux du moment</h2>
  <div id="featuredGamesContainer">
    <div class="sliderContainer">
      <div class="sliderWrapper">
        <?php foreach ($featuredGames as $game): ?>
          <?php
          $steamId = $game['steam_id'];
          $apiId = $game['api_id'];
          $gameTitle = $game['game_title'];
          $imageUrl = "https://cdn.akamai.steamstatic.com/steam/apps/{$steamId}/library_600x900.jpg";
          ?>
          <div class="slide">
            <a href="?action=product&id=<?= $apiId ?>">
              <img src="<?= $imageUrl ?>" alt="<?= $gameTitle ?>">
            </a>
            <p class="gameTitle"><?= $game['game_title'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<div class="container" id="newsContainer">
  <a href="?action=news">
    <h2 class="sectionTitle">News</h2>
  </a>
  <!-- css grid -->
  <div class="news-grid">
    <?php foreach ($news as $n): ?>
      <a href="?action=news&id=<?= $n['news_id'] ?>" class="news-item">
        <img src="<?= $n['thumb_path'] ?>" alt="<?= $n['thumb_alt'] ?>" class="thumb">
        <div class="overlay">
          <h3><?= mb_strimwidth($n['title'], 0, 35, '...') ?></h3>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
  <?php if (isAdmin()): ?>
    <a href="?action=addArticle" id="addArticle">Ajouter une News.</a>
  <?php endif; ?>
</div>

<?php if (isLoggedOn()) : ?>
  <div class="container">
    <!-- css grid -->
    <div class="favorites">
      <h3>Mes Favoris</h3>
    </div>
    <div class="topics">
      <h3>Topics</h3>
    </div>
  </div>
<?php endif; ?>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>