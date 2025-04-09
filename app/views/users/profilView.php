<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div class="profil">
  <p><strong>Pseudo : </strong><?= $user['username'] ?></p>
  <p><strong>Adresse mail :</strong> <?= $user['email'] ?></p>
  <p><strong>Membre depuis :</strong> <?= $user['added_at'] ?></p>
</div>
<a id="deconnexion" href="?action=logout">Deconnexion.</a>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>