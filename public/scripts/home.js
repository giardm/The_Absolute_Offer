fetch("../app/models/getFeaturedOffers.php")
  .then((response) => response.json())
  .then((data) => {

    const container = document.getElementById("featuredGamesContainer");
    container.innerHTML = "";

    data.forEach((item) => {
      const steamId = item.steam_id;
      const apiId = item.api_id;

      const imageUrl = `https://cdn.akamai.steamstatic.com/steam/apps/${steamId}/library_600x900.jpg`;

      const card = document.createElement("div");
      card.classList.add("gameCard");
      card.innerHTML = `
        <a href="?action=product&id=${apiId}"><img src="${imageUrl}" alt="Game ${steamId}"></a>
      `;

      container.appendChild(card);
    });
  })
  .catch((error) => console.error("Error loading games:", error));




