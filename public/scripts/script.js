fetch("../app/api/get_featured_offers.php")
  .then((response) => response.json())
  .then((data) => {
    const gameIds = data.map((item) => item.game_id); // assuming 'game_id' is the actual key
    return Promise.all(
      gameIds.map((id) =>
        fetch(`https://www.cheapshark.com/api/1.0/games?id=${id}`).then((res) =>
          res.json()
        )
      )
    );
  })
  .then((games) => {
    const container = document.getElementById("featuredGamesContainer");
    container.innerHTML = "";

    games.forEach((game) => {
      const card = document.createElement("div");
      card.classList.add("gameCard");
      card.innerHTML = `
        <img src="${game.info.thumb}" alt="${game.info.title}">
        <p class="gameTitle">${game.info.title}</p>
        <p class="gamePrice">${game.deals[0]?.price ?? "N/A"} €</p>
      `;
      container.appendChild(card);
    });
  })
  .catch((error) => console.error("Error loading games:", error));
