<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div class="registerContainer container">
  <h2>Créer un compte</h2>
  <form id="registerForm">
    <input id="email" type="mail" name="email" placeholder="Adresse-email">
    <input id="username" type="text" name="username" placeholder="Nom d'utilisateur">
    <input type="password" id="password" name="password" placeholder="Mot de passe">
    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Mot de passe">
    <button id="submitBtn" type="submit">S'inscrire</button>
  </form>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>