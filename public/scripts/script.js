fetch("../app/models/get_featured_offers.php")
  .then((response) => response.json())
  .then((data) => {
    const container = document.getElementById("featuredGamesContainer");
    container.innerHTML = "";

    data.forEach((item) => {
      const id = item.game_id;
      const imageUrl = `https://cdn.akamai.steamstatic.com/steam/apps/${id}/library_600x900.jpg`;

      const card = document.createElement("div");
      card.classList.add("gameCard");
      card.innerHTML = `
        <a href="?action=product_page"><img src="${imageUrl}" alt="Game ${id}"></a>
      `;
      container.appendChild(card);
    });
  })
  .catch((error) => console.error("Error loading games:", error));


const searchInput = document.getElementById("gameSearchInput");

searchInput.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    let query = searchInput.value.trim().toLowerCase().replace(/\s+/g, '');
    if (query.length > 0) {
      window.location.href = `?action=search&query=${encodeURIComponent(query)}`;
    }
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const query = typeof searchQuery !== "undefined"
    ? searchQuery
    : document.getElementById("searchResults").dataset.query;

  const loader = document.getElementById("loaderContainer");
  const video = document.getElementById("loaderVideo");

  if (video) {
    video.playbackRate = 3;
  }

  if (!query) return;

  // todo ne pas oublier de retirer le faux delai au deploiement !!!

  // fetch(`https://www.cheapshark.com/api/1.0/games?title=${query}`)
  //   .then((res) => res.json())
  //   .then((games) => {
  //     const container = document.getElementById("searchResults");
  //     loader.style.display = "none";
  //     container.innerHTML = "";

  //     if (games.length === 0) {
  //       container.innerHTML = "<p>Aucun jeu trouvé.</p>";
  //       return;
  //     }

  //     games.forEach((game) => {
  //       const card = document.createElement("div");
  //       card.classList.add("gameCard");
  //       card.innerHTML = `
  //         <img src="${game.thumb}" alt="${game.external}">
  //         <p>${game.external}</p>
  //         <p>${game.cheapest} €</p>
  //       `;
  //       container.appendChild(card);
  //     });
  //   })

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
          card.href = "?action=product";
          card.classList.add("searchCard", "animated");
          card.style.animationDelay = `${index * 100}ms`;

          card.innerHTML = `
            <img src="${game.thumb}" alt="${game.external}">
            <div class="gameInfo">
              <p class="title">${game.external}</p>
              
              <p class="cheapest">${game.cheapest} €</p>
            </div>
          `;

          container.appendChild(card);
        });

      }, 3000); //  délai simulé : 3 sec
    })

    .catch((err) => {
      console.error("Erreur :", err);

      loader.style.display = "none";
    });
});

