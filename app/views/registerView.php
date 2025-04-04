<h2>Créer un compte</h2>
<form action="?action=register" method="post">
  <div>
    <label for="email">Adresse e-mail :</label><br>
    <input type="email" id="email" name="email" required>
  </div>

  <div>
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required>
  </div>

  <div>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required minlength="6">
  </div>

  <div>
    <label for="confirm_password">Confirmer le mot de passe :</label><br>
    <input type="password" id="confirmPassword" name="confirm_password" required minlength="6">
  </div>

  <div>
    <button type="submit">S'inscrire</button>
  </div>
</form>