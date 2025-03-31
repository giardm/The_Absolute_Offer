// récuperation id base de donnée
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


// barre de recherche
searchInput.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    let query = searchInput.value.trim().toLowerCase().replace(/\s+/g, '');
    if (query.length > 0) {
      window.location.href = `?action=search&query=${encodeURIComponent(query)}`;
    }
  }
});

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
          card.href = `?action=product&id=${game.gameID}&`;
          card.classList.add("searchCard", "animated");
          card.style.animationDelay = `${index * 100}ms`;

          card.innerHTML = `
            <div class=imgContainer>
            <img src="${game.thumb}" alt="${game.external}">
            </div>
            <div class="gameInfo">
              <p class="title">${game.external}</p>
              
              <p class="cheapest">${game.cheapest} €</p>
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


// lightbox
document.addEventListener("DOMContentLoaded", () => {
  const thumbs = document.querySelectorAll(".screenshotThumb");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImage");
  const closeBtn = document.querySelector(".lightbox .close");
  const prevBtn = document.getElementById("prev");
  const nextBtn = document.getElementById("next");

  let currentIndex = 0;
  const fullImages = Array.from(thumbs).map(img => img.dataset.full);

  function showLightbox(index) {
    currentIndex = index;
    lightboxImg.src = fullImages[currentIndex];
    lightbox.classList.remove("hidden");
  }

  thumbs.forEach(thumb => {
    thumb.addEventListener("click", () => {
      const index = parseInt(thumb.dataset.index);
      showLightbox(index);
    });
  });

  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.add("hidden");
    }
  });

  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + fullImages.length) % fullImages.length;
    showLightbox(currentIndex);
  });

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % fullImages.length;
    showLightbox(currentIndex);
  });

  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("hidden")) {
      if (e.key === "ArrowLeft") prevBtn.click();
      if (e.key === "ArrowRight") nextBtn.click();
      if (e.key === "Escape") closeBtn.click();
    }
  });
});
