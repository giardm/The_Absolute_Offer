<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<h2>Créer un compte</h2>
<form id="registerForm" method="post">
  <div>
    <label for="email">Adresse e-mail :</label><br>
    <input id="email" name="email" />
  </div>

  <div>
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" />
  </div>

  <div>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" />
  </div>

  <div>
    <label for="confirmPassword">Confirmer le mot de passe :</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword" />
  </div>

  <div>
    <button id="submitBtn" type="submit">S'inscrire</button>
  </div>
</form>


<?php require VIEWS_PATH . "/partials/footerView.php"; ?>