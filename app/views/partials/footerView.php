<!--
  ======================================================
  Toast de notification, masqué par défaut.
  Utilisé pour afficher des messages contextuels temporaires.
  ======================================================
-->
<div id="messageDisplay" class="toast hidden"></div>

</main>

<!--
  ======================================================
  Pied de page principal du site.
  Contient logo, navigation par sections, et informations légales.
  ======================================================
-->
<footer>
  <hr>
  <div class="footerContainer">

    <!-- Logo de pied de page -->
    <div class="footerLogo">
      <img src="./public/images/logo/tao-footer-logo.svg" alt="TAO logo">
    </div>

    <!-- Section : Liens liés au compte utilisateur -->
    <div class="footerColumn">
      <h4 class="footerTitle">Compte</h4>
      <ul>
        <?php if (isLoggedOn()): ?>
          <li><a href="?action=profil">Profil</a></li>
          <?php if (!isAdmin()): ?>
            <li>
              <a id="deleteProfil" href="?action=deleteProfil"
                aria-label="Supprimer mon compte utilisateur">Supprimer<br>mon<br>compte</a>
            </li>
          <?php endif; ?>
        <?php else : ?>
          <li><a href="?action=login">Connexion</a></li>
          <li><a href="?action=register">Inscription</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <!-- Section : Raccourcis vers les jeux mis en avant -->
    <div class="footerColumn">
      <h4 class="footerTitle">Jeux du moments</h4>
      <ul>
        <?php foreach ($featuredGames as $game): ?>
          <li>
            <a href="?action=product&id=<?= $apiId = $game['api_id']; ?>"
              aria-label="Consulter la page de <?= htmlspecialchars($game['game_title']) ?>">
              <?= $game['game_title'] ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Section : Informations légales et contact -->
    <div class="footerColumn">
      <h4 class="footerTitle">Support</h4>
      <ul>
        <li>CGU</li>
        <li>Mentions <br> légales</li>
      </ul>
    </div>

  </div>
</footer>

</div>
</body>

</html>