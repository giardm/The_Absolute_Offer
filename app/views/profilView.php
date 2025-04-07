<div class="profil">
  <p><strong>Pseudo : <?=$user['username']?></strong></p>
  <p><strong>Adresse mail : <?=$user['email']?></strong></p>
  <p><strong>Membre depuis : <?=$user['added_at']?></strong></p>

  <?php
  var_dump($user);
  ?>
</div>
<a href="?action=logout">Deconnexion.</a>