<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Résultats de recherche.
  Affiche une animation de chargement, puis les résultats dynamiques côté client.
  ======================================================
-->

<!-- Conteneur de chargement animé avec logo -->
<div id="loaderContainer">
  <video id="loaderVideo" autoplay muted loop playsinline>
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
</div>

<!--
  Conteneur destiné à recevoir dynamiquement les résultats de recherche.
  L'attribut data-query contient la requête pour traitement JS.
-->
<div class="container" id="searchResults"
  data-query="<?php echo htmlspecialchars($query); ?>"
  aria-label="Résultats de la recherche"></div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>