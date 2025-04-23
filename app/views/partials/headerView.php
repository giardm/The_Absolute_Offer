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
        aria-label non requis ici car l’image est suivie d’un lien clair vers l’accueil.
      -->
      <div class="logo">
        <a href="?action=home">
          <img id="mobileLogo" src="./public/images/logo/logo-03-b.webp" alt="Logo TAO version mobile">
        </a>
        <a href="?action=home">
          <img id="desktopLogo" src="./public/images/logo/logo-04-b.webp" alt="Logo TAO version bureau">
        </a>
      </div>

      <!--
        Barre de recherche avec champ textuel et bouton d’accès mobile.
        Le champ utilise aria-label pour être accessible aux lecteurs d’écran.
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
        Le lien contient une icône avec un alt clair.
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