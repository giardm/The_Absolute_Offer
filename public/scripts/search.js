//video
document.addEventListener("DOMContentLoaded", () => {
  const query = typeof searchQuery !== "undefined"
    ? searchQuery
    : document.getElementById("searchResults").dataset.query;

  const loader = document.getElementById("loaderContainer");
  const video = document.getElementById("loaderVideo");

  if (video) {
    video.playbackRate = 3;
  }

  // requete api
  if (!query) return;
  fetch(`https://www.cheapshark.com/api/1.0/games?title=${query}`)
    .then((res) => res.json())
    .then((games) => {
      // Simulation d’un délai de 3 secondes
      setTimeout(() => {
        const container = document.getElementById("searchResults");
        loader.classList.add("hidden");

        container.innerHTML = "";

        if (games.length === 0) {
          container.innerHTML = "<p>Aucun jeu trouvé.</p>";
          return;
        }

        games.forEach((game, index) => {
          const card = document.createElement("a");
          // card.href = `?action=product&id=${game.gameID}`;
          card.classList.add("searchCard", "animated");
          card.style.animationDelay = `${index * 100}ms`;

          card.innerHTML = `
            <div class=imgContainer>
            <img src="${game.thumb}" alt="${game.external}">
            </div>
            <div class="gameInfo">
              <p class="title">${game.external}</p>
              <p class="retailPrice">Prix d'origine : ${game.cheapest} €</p>
              <a class="cheapest" href= "?action=product&id=${game.gameID}">Voir les offres</a>
            </div>
          `;

          container.appendChild(card);
        });

      }, 1000);
    })

    .catch((err) => {
      console.error("Erreur :", err);

      loader.style.display = "none";
    });
});