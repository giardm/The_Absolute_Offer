document.addEventListener("DOMContentLoaded", () => {
  // Récupère la requête de recherche (si elle est définie globalement, sinon depuis le HTML)
  const query = typeof searchQuery !== "undefined"
    ? searchQuery
    : document.getElementById("searchResults").dataset.query;

  // Références à l’élément loader et à la vidéo d’animation de chargement
  const loader = document.getElementById("loaderContainer");
  const video = document.getElementById("loaderVideo");

  // Si la vidéo existe, on accélère sa vitesse de lecture
  if (video) {
    video.playbackRate = 3; // Lecture x3
  }

  // Si aucune requête de recherche n’est disponible, on arrête l’exécution
  if (!query) return;

  // Appel de l’API CheapShark pour chercher des jeux correspondant au titre
  fetch(`https://www.cheapshark.com/api/1.0/games?title=${query}`)
    .then((res) => res.json()) // On convertit la réponse en JSON
    .then((games) => {
      // Simulation d’un petit délai (1s ici) pour laisser le temps au loader de jouer
      setTimeout(() => {
        const container = document.getElementById("searchResults");
        loader.classList.add("hidden"); // Cache le loader

        container.innerHTML = ""; // Vide les résultats précédents

        // Si aucun jeu n’est trouvé
        if (games.length === 0) {
          container.innerHTML = "<p>Aucun jeu trouvé.</p>";
          return;
        }

        // Sinon, pour chaque jeu trouvé :
        games.forEach((game, index) => {
          const card = document.createElement("a"); // Crée une carte de résultat
          // Lien désactivé ici, mais peut être activé si besoin :
          // card.href = `?action=product&id=${game.gameID}`;
          card.classList.add("searchCard", "animated"); // Ajoute les classes de style/animation
          card.style.animationDelay = `${index * 100}ms`; // Décalage de l’animation selon l’index

          // Structure HTML de la carte
          card.innerHTML = `
            <div class=imgContainer>
              <img src="${game.thumb}" alt="${game.external}">
            </div>
            <div class="gameInfo">
              <p class="title">${game.external}</p>
              <a class="cheapest" href="?action=product&id=${game.gameID}">Voir les offres</a>
            </div>
          `;

          // Ajoute la carte dans le conteneur
          container.appendChild(card);
        });

      }, 1000); // Délai d'une seconde
    })

    // Gestion des erreurs en cas d’échec de la requête
    .catch((err) => {
      console.error("Erreur :", err);
      loader.style.display = "none"; // Cache le loader en cas d’erreur
    });
});
