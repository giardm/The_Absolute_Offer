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

    <!-- Champ : Confirmation du