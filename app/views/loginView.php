    <h2>Se connecter</h2>
    <form action="?action=login" method="post">
        <div>
            <label label for="username_or_email">Nom d’utilisateur ou Email :</label><br>
            <input type="text" id="username_or_email" name="username_or_email" required>
        </div>
        
        <div>
              <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Connexion</button>
            <a href="?action=register">Pas encore inscrit ?</a>
        </div>
    </form>

