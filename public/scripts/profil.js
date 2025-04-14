document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.favoriteCard');

  cards.forEach(async (card) => {
    const gameId = card.dataset.gameId;
    const title = card.querySelector('.gameTitle');
    const image = card.querySelector('.gameImage');

    // 🔷 Active skeleton sur l'image et le titre
    title.classList.add('skeleton');
    image.classList.add('skeleton');

    const data = await fetchGameData(gameId);

    if (data) {
      renderGameCard(card, data);
    } else {
      renderError(card);
    }

    // ✅ Supprime skeleton une fois chargé
    title.classList.remove('skeleton');
    image.classList.remove('skeleton');
  });
});

/**
 * Récupère les données d’un jeu depuis l’API CheapShark
 * @param {string} gameId
 * @returns {Promise<Object|null>}
 */
async function fetchGameData(gameId) {
  try {
    const res = await fetch(`https://www.cheapshark.com/api/1.0/games?id=${gameId}`);
    if (!res.ok) throw new Error("Erreur API");
    return await res.json();
  } catch (error) {
    console.error(`Erreur de chargement pour game ${gameId}`, error);
    return null;
  }
}

/**
 * Injecte les données dans la carte jeu
 * @param {HTMLElement} card
 * @param {Object} game
 */
function renderGameCard(card, game) {
  const image = card.querySelector('.gameImage');
  const title = card.querySelector('.gameTitle');
  const link = card.querySelector('.favoriteLink');

  const steamAppId = game.info?.steamAppID;

  // ✅ Image version "affiche" Steam
  image.src = steamAppId
    ? `https://cdn.cloudflare.steamstatic.com/steam/apps/${steamAppId}/library_600x900.jpg`
    : game.info.thumb;

  image.alt = game.info.title;
  title.textContent = game.info.title;
}

/**
 * Affiche une erreur sur la carte en cas d’échec de l’API
 * @param {HTMLElement} card
 */
function renderError(card) {
  const title = card.querySelector('.gameTitle');
  title.textContent = "Erreur de chargement";
}
