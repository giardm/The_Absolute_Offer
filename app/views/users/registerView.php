<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Formulaire d'inscription.
  Permet aux utilisateurs de créer un compte.
  ======================================================
-->

<div class="registerContainer">
  <h2>Créer un compte</h2>

  <form id="registerForm" aria-label="Formulaire de création de compte">

    <!-- Champ : Adresse e-mail -->
    <input
      id="email"
      type="email"
      name="email"
      placeholder="Adresse-email"
      aria-label="Adresse e-mail"
      required>

    <!-- Champ : Nom d'utilisateur -->
    <input
      id="username"
      type="text"
      name="username"
      placeholder="Nom d'utilisateur"
      aria-label="Nom d'utilisateur"
      required>

    <!-- Champ : Mot de passe -->
    <input
      type="password"
      id="password"
      name="password"
      placeholder="Mot de passe"
      aria-label="Mot de passe"
      required>

    <!-- Champ : Confirmation du mot de passe -->
    <input
      type="password"
      id="confirmPassword"
      name="confirmPassword"
      placeholder="Mot de passe"
      aria-label="Confirmer le mot de passe"
      required>

    <!-- Bouton de soumission -->
    <button id="submitBtn" type="submit" aria-label="Valider la création du compte">S'inscrire</button>

    <!-- Lien vers le formulaire de connexion -->
    <a href="?action=login">J'ai déjà un compte.</a>

  </form>
</div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>