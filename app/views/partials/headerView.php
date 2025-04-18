<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="UTF-8">
  <meta name="description" content="Avec The Absolute Offer, trouve les meilleurs prix pour tes jeux vidéo, suis les news gaming, et garde tes titres favoris à portée de clic.">
  <meta description="" name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/styles.css">
  <link rel="icon" type="image/x-icon" href="./public/images/logo/logo-03.webp">
  <?php if ($action == "addArticle"): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/ui/trumbowyg.min.css">
  <?php endif; ?>
  <script type="module" src="./public/scripts/<?= $action ?>.js"></script>
  <script type="module" src="./public/scripts/searchbar.js"></script>
  <title id="pageTitle">
    <?php
    echo isset($pageTitles[$action]) && $pageTitles[$action] !== ''
      ? "TAO - {$pageTitles[$action]}"
      : "TAO";
    ?>
  </title>


</head>

<body>
  <header>
    <div class="logo">
      <a href="?action=home"><img id="mobileLogo" src="./public/images/logo/logo-03-b.webp" alt=""></a>
      <a href="?action=home"><img id="desktopLogo" src="./public/images/logo/logo-04-b.webp" alt=""></a>
    </div>
    <div class="searchContainer">
      <div class="searchInput">
        <img src="./public/images/logo/magnifying-glass.svg" alt="">
        <input id="gameSearchInput" type="text" placeholder="Recherchez un jeu au meilleur prix..." aria-label="Champ de recherche de jeux vidéo">
      </div>

      <button class="searchButton">
        <img src="./public/images/logo/magnifying-glass.svg" alt="">
      </button>
    </div>
    <div class="login">
      <a href=<?php if (isLoggedOn()):
                echo "'?action=profil'" ?>
        <?php else :
                echo "'?action=login'" ?>
        <?php endif; ?>>

        <img src="./public/images/logo/login.svg" alt="">
      </a>
    </div>
  </header>