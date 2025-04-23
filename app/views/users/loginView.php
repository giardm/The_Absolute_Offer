<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Formulaire de connexion.
  Permet à l’utilisateur de se connecter à son compte.
  ======================================================
-->

<div class="loginContainer">
  <h2>Se connecter</h2>

  <form id="loginForm" aria-label="Formulaire de connexion">
    <!-- Champ pour l'identifiant (email ou pseudo) -->
    <input
      type="text"
      name="identifier"
      placeholder="Email ou pseudo"
      required
      aria-label="Adresse email ou nom d'utilisateur">

    <!-- Champ pour le mot de passe -->
    <input
      type="password"
      name="password"
      placeholder="Mot de passe"
      required
      aria-label="Mot de passe">

    <!-- Bouton de soumission -->
    <button type="submit" aria-label="Se connecter à votre compte">Se connecter</button>

    <!-- Lien vers l’inscription -->
    <a href="?action=register">Créer un compte.</a>
  </form>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>