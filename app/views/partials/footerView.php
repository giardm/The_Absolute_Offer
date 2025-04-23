<div id="messageDisplay" class="toast hidden"></div>

</main>
<footer>
  <hr>
  <div class="footerContainer">
    <div class="footerLogo">
      <img src="./public/images/logo/tao-footer-logo.svg" alt="TAO logo">
    </div>

    <div class="footerColumn">
      <h4 class="footerTitle">Compte</h4>
      <ul>
        <?php if (isLoggedOn()): ?>
          <li><a href="?action=profil">Profil</a></li>
          <li><a id="deleteProfil" href="?action=deleteProfil">Supprimer<br>mon<br>compte</a></li>
        <?php else : ?>
          <li><a href="?action=login">Connexion</a></li>
          <li><a href="?action=register">Inscription</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="footerColumn">
      <h4 class="footerTitle">Jeux du moments</h4>
      <ul>
        <?php foreach ($featuredGames as $game): ?>
          <li>
            <a href="?action=product&id=<?= $apiId = $game['api_id']; ?>">
              <?= $game['game_title'] ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footerColumn">
      <h4 class="footerTitle">Support</h4>
      <ul>
        <li>CGU</li>
        <li>Mentions <br> légales</li>
        <li>Contact</li>
      </ul>
    </div>
  </div>
</footer>
</div>

</body>

</html>