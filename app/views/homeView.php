<?php var_dump($_SESSION);?>
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
    <?php foreach ($featuredGames as $game): ?>
      <?php
      $steamId = $game['steam_id'];
      $apiId = $game['api_id'];
      $gameTitle = $game['game_title'];
      $imageUrl = "https://cdn.akamai.steamstatic.com/steam/apps/{$steamId}/library_600x900.jpg";
      ?>
      <div class="gameCard">
        <a href="?action=product&id=<?= $apiId ?>">
          <img src="<?= $imageUrl ?>" alt="<?= $gameTitle ?>">
        </a>
      </div>
    <?php endforeach; ?>

  </div>
</div>


<div class="container">


  <h2>News</h2>

  <!-- css grid -->

</div>

<div class="container">
  <!-- css grid -->
  <div class="favorites">
    <h3>Mes Favoris</h3>
  </div>
  <div class="topics">
    <h3>Topics</h3>
  </div>
</div>