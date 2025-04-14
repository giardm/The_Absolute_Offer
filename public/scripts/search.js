/**
 * ============================================
 * Search Results Handler – Intégration CheapShark
 * --------------------------------------------
 * Comportement :
 * - Récupère une requête utilisateur (depuis JS ou HTML)
 * - Effectue une recherche de jeux via l’API CheapShark
 * - Affiche dynamiquement des cartes de résultats
 * - Gère les cas vides et les erreurs réseau
 * ============================================
 */

/**
 * Point d’entrée principal : exécuté dès que le DOM est entièrement chargé.
 * Initialise la logique de recherche, appelle l’API CheapShark et gère l’affichage.
 */
document.addEventListener("DOMContentLoaded", () => {
  /**
   * Récupère la requête de recherche soit depuis une variable JS globale (`searchQuery`),
   * soit depuis un attribut HTML `data-query` de l’élément contenant les résultats.
   * @type {string}
   */
  const query =
    typeof searchQuery !== "undefined"
      ? searchQuery
      : document.getElementById("searchResults").dataset.query;

  // Références DOM : animation de chargement
  const loader = document.getElementById("loaderContainer");
  const video = document.getElementById("loaderVideo");

  // Accélère la lecture de la vidéo du loader (x3)
  if (video) {
    video.playbackRate = 3;
  }

  // Si aucune requête n’est disponible, on interrompt le script
  if (!query) return;

  /**
   * Requête à l'API CheapShark avec le titre du jeu
   */
  fetch(`https://www.cheapshark.com/api/1.0/games?title=${query}`)
    .then((res) => res.json()) // Transforme la réponse en JSON
    .then((games) => {
      /**
       * Simulation d’un délai d’animation avant affichage (UX)
       * Permet de laisser le loader visible 1 seconde
       */
      setTimeout(() => {
        const container = document.getElementById("searchResults");

        // Cache le loader visuel
        loader.classList.add("hidden");

        // Vide les résultats précédents s'il y en avait
        container.innerHTML = "";

        // Si aucun jeu n’a été trouvé
        if (games.length === 0) {
          container.innerHTML = "<p>Aucun jeu trouvé.</p>";
          return;
        }

        // Pour chaque jeu trouvé, créer une carte
        games.forEach((game, index) => {
          const card = document.createElement("a");
          card.classList.add("searchCard", "animated");
          card.style.animationDelay = `${index * 100}ms`;

          // Structure HTML injectée dans la carte
          card.innerHTML = `
            <div class="imgContainer">
              <img src="${game.thumb}" alt="${game.external}">
            </div>
            <div class="gameInfo">
              <p class="title">${game.external}</p>
              <a class="cheapest" href="?action=product&id=${game.gameID}">Voir les offres</a>
            </div>
          `;

          // Ajoute la carte au conteneur
          container.appendChild(card);
        });
      }, 1000);
    })
    /**
     * Gestion des erreurs réseau ou de parsing JSON
     */
    .catch((err) => {
      console.error("Erreur :", err);
      loader.style.display = "none"; // Cache le loader en cas d’échec
    });
});
