<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Confirmation de suppression de compte utilisateur.
  Présente un message et deux boutons d'action.
  ======================================================
-->

<div class="container">
  <!-- Message de confirmation -->
  <p id="confirmDelete">Vous êtes sûr de vouloir supprimer votre compte ?</p>

  <!-- Boutons d'action -->
  <div class="buttons">
    <button id="confirm" class="success" aria-label="Confirmer la suppression du compte">Oui</button>
    <button id="cancel" class="warning" aria-label="Annuler la suppression du compte">Non</button>
  </div>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>