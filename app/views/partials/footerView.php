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
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 395.47 137.4">
        <path class="cls-1" d="M68.7,0h-35.27c0,18.43-14.99,33.43-33.43,33.43v35.27c37.94,0,68.7-30.76,68.7-68.7Z" />
        <path class="cls-1" d="M102.12,137.4v-35.27c-18.43,0-33.43-14.99-33.43-33.43h-35.27c0,37.94,30.76,68.7,68.7,68.7Z" />
        <rect class="cls-1" x="68.7" y="33.43" width="35.27" height="35.27" />
        <path class="cls-1" d="M326.77,0c-37.94,0-68.7,30.76-68.7,68.7s30.76,68.7,68.7,68.7,68.7-30.76,68.7-68.7S364.71,0,326.77,0ZM326.77,102.12c-18.43,0-33.43-14.99-33.43-33.43s14.99-33.43,33.43-33.43,33.43,14.99,33.43,33.43-14.99,33.43-33.43,33.43Z" />
        <path class="cls-1" d="M166.71,102.12h0c-9.74,0-17.64,7.9-17.64,17.64s7.9,17.64,17.64,17.64h0c9.74,0,17.64-7.9,17.64-17.64s-7.9-17.64-17.64-17.64Z" />
        <path class="cls-1" d="M216.76,68.7v-35.27h-60.81c0,18.43-14.99,33.43-33.43,33.43v35.27c25.05,0,46.96-13.41,58.96-33.44v.02c0,37.94,30.76,68.7,68.7,68.7v-35.27c-18.43,0-33.43-14.99-33.43-33.43Z" />
      </svg>
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
        <li><a href="?action=cgu">CGU</a></li>
        <li><a href="?action=legalNotices">Mentions <br> légales</a></li>
      </ul>
    </div>

  </div>
  <p class="copyright">©The Absolute Offer. Tous droits réservés. 2025</p>
</footer>

</div>
</body>

</html>