<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Avec The Absolute Offer, trouve les meilleurs prix pour tes jeux vidéo, suis les news gaming, et garde tes titres favoris à portée de clic.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Feuille de style principale -->
  <link rel="stylesheet" href="./public/styles.css">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="./public/images/logo/logo-03.webp">

  <!-- Chargement conditionnel de la feuille de style pour l’éditeur Trumbowyg -->
  <?php if ($action == "addArticle"): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/ui/trumbowyg.min.css">
  <?php endif; ?>

  <!-- Scripts principaux -->
  <script type="module" src="./public/scripts/<?= $action ?>.js"></script>
  <script type="module" src="./public/scripts/searchbar.js"></script>

  <!-- Titre dynamique selon la page -->
  <title id="pageTitle">
    <?php
    echo isset($pageTitles[$action]) && $pageTitles[$action] !== ''
      ? "TAO - {$pageTitles[$action]}"
      : "TAO";
    ?>
  </title>
</head>

<body>
  <div class="wrapper">
    <header>
      <!--
        Logo du site, version mobile et desktop.
      -->
      <div class="logo">
        <a href="?action=home">
          <svg id="mobileLogo" alt="Logo TAO version mobile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94.59 94.59">
            <path class="cls-1" d="M47.29,94.59C21.22,94.59,0,73.37,0,47.29S21.22,0,47.29,0s47.29,21.22,47.29,47.29-21.22,47.29-47.29,47.29ZM47.29,13c-18.91,0-34.29,15.38-34.29,34.29s15.38,34.29,34.29,34.29,34.29-15.38,34.29-34.29S66.2,13,47.29,13Z" />
            <path class="cls-1" d="M23.87,47.91c13.98,0,25.32-11.34,25.32-25.32h-13c0,6.79-5.53,12.32-12.32,12.32v13Z" />
            <path class="cls-1" d="M61.51,60.23c-6.79,0-12.32-5.53-12.32-12.32h-13c0,13.98,11.34,25.32,25.32,25.32v-13Z" />
            <rect class="cls-1" x="49.19" y="34.91" width="13" height="13" />
          </svg>
        </a>
        <a href="?action=home">
          <svg id="desktopLogo" alt="Logo TAO version bureau" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 525.47 256.65">
            <path class="cls-1" d="M135.06,59.63h-35.27c0,18.43-14.99,33.43-33.43,33.43v35.27c37.94,0,68.7-30.76,68.7-68.7Z" />
            <path class="cls-1" d="M168.48,197.03v-35.27c-18.43,0-33.43-14.99-33.43-33.43h-35.27c0,37.94,30.76,68.7,68.7,68.7Z" />
            <rect class="cls-1" x="135.06" y="93.05" width="35.27" height="35.27" />
            <path class="cls-1" d="M393.13,59.63c-37.94,0-68.7,30.76-68.7,68.7s30.76,68.7,68.7,68.7,68.7-30.76,68.7-68.7-30.76-68.7-68.7-68.7ZM393.13,161.75c-18.43,0-33.43-14.99-33.43-33.43s14.99-33.43,33.43-33.43,33.43,14.99,33.43,33.43-14.99,33.43-33.43,33.43Z" />
            <path class="cls-1" d="M397.15,0H128.33C57.57,0,0,57.57,0,128.33s57.57,128.33,128.33,128.33h268.82c70.76,0,128.33-57.57,128.33-128.33S467.91,0,397.15,0ZM397.15,221.38H128.33c-51.31,0-93.05-41.74-93.05-93.05s41.74-93.05,93.05-93.05h268.82c51.31,0,93.05,41.74,93.05,93.05s-41.74,93.05-93.05,93.05Z" />
            <path class="cls-1" d="M233.07,161.75h0c-9.74,0-17.64,7.9-17.64,17.64s7.9,17.64,17.64,17.64h0c9.74,0,17.64-7.9,17.64-17.64s-7.9-17.64-17.64-17.64Z" />
            <path class="cls-1" d="M283.11,128.33v-35.27h-60.81c0,18.43-14.99,33.43-33.43,33.43v35.27c25.05,0,46.96-13.41,58.96-33.44v.02c0,37.94,30.76,68.7,68.7,68.7v-35.27c-18.43,0-33.43-14.99-33.43-33.43Z" />
          </svg>
        </a>
      </div>

      <!--
        Barre de recherche avec champ textuel et bouton d’accès mobile.
      -->
      <div class="searchContainer">
        <div class="searchInput" id="searchInputContainer">
          <img src="./public/images/logo/magnifying-glass.svg" alt="Icône de recherche">
          <input
            id="gameSearchInput"
            type="text"
            placeholder="Recherchez un jeu au meilleur prix..."
            aria-label="Champ de recherche de jeux vidéo"
            value="<?php echo ($action === 'search') ? htmlspecialchars($query) : ''; ?>">
        </div>

        <!-- Bouton pour afficher la barre de recherche sur mobile -->
        <button class="searchButton" id="mobileSearchToggle" aria-label="Ouvrir la recherche sur mobile">
          <img src="./public/images/logo/magnifying-glass.svg" alt="">
        </button>
      </div>

      <!--
        Zone de connexion ou accès au profil selon l’état de session.
      -->
      <div class="login">
        <a href=<?php if (isLoggedOn()): ?> '?action=profil'
          <?php else: ?> '?action=login'
          <?php endif; ?>>
          <img id="loginIcon" src="./public/images/logo/login.svg" alt="Icône de connexion ou de profil">
        </a>
      </div>
    </header>

    <!-- Début du contenu principal -->
    <main>