import { showMessage } from "./messageDisplay.js"; // Affichage des messages d’état (toast)
import { createModal } from "./modalOffers.js";

document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.favoriteCard');
  const deleteToggleButton = document.getElementById('toggleDeleteMode');


  initializeCards(cards);
  initializeDeleteMode(cards, deleteToggleButton);
  bindDeleteActions();

  createModal();
});

/**
 * Initialise les cartes : skeleton + données
 * @param {NodeListOf<HTMLElement>} cards
 */
function initializeCards(cards) {
  cards.forEach(async (card) => {
    const gameId = card.dataset.gameId;
    const title = card.querySelector('.gameTitle');
    const image = card.querySelector('.gameImage');

    title.classList.add('skeleton');
    image.classList.add('skeleton');

    const data = await fetchGameData(gameId);

    if (data) {
      renderGameCard(card, data);
    } else {
      renderError(card);
    }

    title.classList.remove('skeleton');
    image.classList.remove('skeleton');
  });
}

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
 * Injecte les données dans une carte jeu
 * @param {HTMLElement} card
 * @param {Object} game
 */
function renderGameCard(card, game) {
  const image = card.querySelector('.gameImage');
  const title = card.querySelector('.gameTitle');

  const steamAppId = game.info?.steamAppID;

  image.src = steamAppId
    ? `https://cdn.cloudflare.steamstatic.com/steam/apps/${steamAppId}/library_600x900.jpg`
    : game.info.thumb;

  image.alt = game.info.title;
  title.textContent = game.info.title;
}

/**
 * Affiche une erreur sur la carte
 * @param {HTMLElement} card
 */
function renderError(card) {
  const title = card.querySelector('.gameTitle');
  title.textContent = "Erreur de chargement";
}

/**
 * Initialise le mode suppression
 * @param {NodeListOf<HTMLElement>} cards
 * @param {HTMLElement|null} toggleBtn
 */
function initializeDeleteMode(cards, toggleBtn) {
  let deleteMode = false;

  if (!toggleBtn) return;

  cards.forEach(card => {
    card.addEventListener('click', (e) => {
      if (deleteMode) {
        e.stopImmediatePropagation(); // empêche la modale
      }
    });
  });

  toggleBtn.addEventListener('click', () => {
    deleteMode = !deleteMode;

    cards.forEach(card => {
      card.classList.toggle('deletionActive', deleteMode);
    });

    toggleBtn.textContent = deleteMode ? 'Valider' : 'Supprimer un jeu';
    toggleBtn.classList.toggle('validate', deleteMode);
  });
}

/**
 * Gère les clics sur les boutons de suppression individuelle
 */
function bindDeleteActions() {
  document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      const favoriteId = button.dataset.favoriteId;

      deleteFavorite(favoriteId, button.closest('.favoriteCard'));
    });
  });
}

/**
 * Supprime un favori via AJAX + retire la carte du DOM
 * @param {string} favoriteId
 * @param {HTMLElement} cardElement
 */
async function deleteFavorite(favoriteId, cardElement) {
  try {
    const res = await fetch("?action=favorite", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ favoriteId })
    });

    const data = await res.json();

    if (data.success) {
      showMessage(data.message, "success");

      //  Retire la carte du DOM
      if (cardElement) {
        cardElement.remove();
        checkIfFavoritesAreEmpty();
      }
    } else {
      showMessage(data.message, "error");
    }
  } catch (err) {
    showMessage("Erreur réseau lors de la suppression", "error");
  }
}


/**
 * Change l'affichage de la section favoris si il n'y a aucun jeux
 */
function checkIfFavoritesAreEmpty() {
  const wrapper = document.querySelector('.favoritesWrapper');
  const cards = wrapper.querySelectorAll('.favoriteCard');

  if (cards.length === 0) {
    // 🔹 Afficher le message s’il n’est pas déjà présent
    if (!document.querySelector('.noFavorites')) {
      wrapper.insertAdjacentHTML('beforebegin', `
        <p class="noFavorites">Vous n'avez aucun jeu en favoris.</p>
      `);
    }

    // 🔹 Supprimer le bouton de suppression s’il est présent
    const deleteToggleButton = document.getElementById('toggleDeleteMode');
    if (deleteToggleButton) {
      deleteToggleButton.remove();
    }
  }
}
