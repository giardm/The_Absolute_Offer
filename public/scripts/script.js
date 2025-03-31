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
