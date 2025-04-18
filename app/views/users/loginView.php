<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div class="loginContainer ">
  <h2>Se connecter</h2>
  <form id="loginForm">
    <input type="text" name="identifier" placeholder="Email ou pseudo" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
    <a href="?action=register">Créer un compte.</a>
  </form>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>