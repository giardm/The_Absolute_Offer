<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Page d'erreur 404 ou équivalent.
  Affiche un message d'erreur simple dans un conteneur.
  ======================================================
-->

<div class="container">

  <!-- Message principal affiché à l'utilisateur -->
  <div class="pageNotFound">
    <p>404</p>
    <p>Cette page n'existe pas.</p>
    <a href="?action=home">Retour a la page d'accueil</a>
  </div>

</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>