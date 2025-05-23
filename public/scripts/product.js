/**
 * ============================================
 * Product.js – Gestion des offres via CheapShark & Steam
 * --------------------------------------------
 * Comportement :
 * - Charge dynamiquement les offres d'un jeu (prix, visuels, détails)
 * - Utilise les APIs CheapShark & Steam
 * - Gère modale, lightbox, interactions, affichage enrichi
 * ============================================
 */
/**
 * Import fonction d'affichage et de gestion des messages
 */
import { showMessage } from "./messageDisplay.js";

import { createOffer, getStoresList, createModal, addSavingscolors } from "./modalOffers.js";

/**
 * Point d'entrée principal une fois le DOM entièrement chargé.
 * Lance le chargement des offres CheapShark.
 */

document.addEventListener("DOMContentLoaded", async () => {
  const loader = document.getElementById("loaderContainer");
  const mainContent = document.querySelector(".container");
  const loaderVideo = document.getElementById("loaderVideo");

  if (mainContent) mainContent.style.display = "none";
  if (loaderVideo) loaderVideo.playbackRate = 3;

  // Charge toutes les infos (CheapShark + Steam)
  await getCheapSharkInfos();

  // Optionnel : pré-attente pour laisser le layout se stabiliser (200–400ms max)
  setTimeout(() => {
    if (loader) loader.classList.add("hidden");
    if (mainContent) mainContent.style.display = "block";
  }, 1800); // ← ajuster ici le timer
});

/**
 * Extrait l'identifiant du jeu depuis le conteneur principal.
 * @returns {string} ID utilisé pour les requêtes CheapShark.
 */
function getProductId() {
  const container = document.querySelector(".container");
  const gameId = container.dataset.id;
  return gameId;
}

/**
 * Récupère les offres d’un jeu depuis l’API CheapShark
 * et injecte les résultats dans le DOM (modale, lightbox, etc.).
 * @async
 * @returns {Promise<void>}
 */
async function getCheapSharkInfos() {
  const gameId = getProductId();

  const storeList = await getStoresList(); // Liste des magasins avec leur nom/logo
  const offerListElement = document.querySelector(".offerList");
  const overlayList = document.querySelector(".offersOverlay .offerList");
  const openBtn = document.getElementById("openOffersOverlay");

  // Récupère les données du jeu via son ID
  fetch(`https://www.cheapshark.com/api/1.0/games?id=${gameId}`)
    .then((res) => res.json())
    .then((infos) => {
      if (!infos.deals || infos.deals.length === 0) {
        offerListElement.innerHTML = "<li>Aucune offre disponible.</li>";
        return;
      }

      const steamAppID = infos.info.steamAppID;
      const gameTitle = infos.info.title;
      const domGameTitle = document.querySelector(".gameTitle");

      domGameTitle.textContent = gameTitle;

      if (steamAppID) {
        getSteamInfos(steamAppID);
      } else {
        cleanDom();
      }

      // Génération des éléments HTML pour chaque offre
      infos.deals.forEach((deal, index) => {
        const store = storeList[deal.storeID] || { name: "Inconnu", logo: "" };
        const offerElement = createOffer(deal, store);

        // Ajout des 4 premières offres dans la page principale
        if (index < 4) {
          offerListElement.appendChild(offerElement.cloneNode(true));
        }

        // Toutes les offres sont ajoutées à la modale
        overlayList.appendChild(offerElement);
      });

      // Affiche le bouton "Afficher toutes les offres" si plus de 4
      if (infos.deals.length > 4 && openBtn) {
        openBtn.classList.remove("hidden");
      }
      //Ajoute le bouton pour l'admin
      addFeaturedOfferButton(steamAppID, gameId, gameTitle);
      //Ajoute le bouton pour les favoris
      addFavorite(gameId);
      //creation de la modale
      createModal();
      addSavingscolors(); // Applique une couleur selon le niveau de réduction
    })
    .catch((err) => {
      console.error("Erreur lors du chargement des offres :", err);
    });
}

/**
 * Récupère les informations Steam d’un jeu via l’API interne.
 * @param {string} steamAppID - Identifiant du jeu sur Steam.
 */
async function getSteamInfos(steamAppID) {
  try {
    const res = await fetch(`?action=steamInfo&appid=${steamAppID}`);
    const data = await res.json();

    if (!data[steamAppID] || !data[steamAppID].success) {
      console.warn("Données Steam non disponibles pour ce jeu.");
      return;
    }

    const steamData = data[steamAppID].data;

    renderSteamHeader(steamData);

    renderSteamInformations(steamData);

    renderSteamMedia(steamData);
  } catch (error) {
    console.error("Erreur lors de la récupération des infos Steam :", error);
  }
}

/**
 * Injecte la bannière, la jaquette et le titre du jeu dans le header.
 * @param {Object} steamData - Données du jeu récupérées via Steam.
 */
function renderSteamHeader(steamData) {
  const headerImage = document.querySelector(".headerImage");
  const gameCover = document.querySelector(".gameCover");
  const gameTitle = document.querySelector(".gameTitle");

  if (!headerImage || !gameCover || !gameTitle) return;

  // Bannière horizontale (ex : 460x215)
  headerImage.src = steamData.header_image;

  // Affiche verticale (portrait) via ID Steam
  gameCover.src = `https://cdn.akamai.steamstatic.com/steam/apps/${steamData.steam_appid}/library_600x900.jpg`;

  // Titre
  gameTitle.textContent = steamData.name;
  document.title = "TAO – " + gameTitle.textContent;
  document.getElementById("pageTitle").textContent = document.title;
}

/**
 * Affiche les informations générales du jeu (date, genres, éditeur).
 * @param {Object} steamData - Informations textuelles du jeu Steam.
 */
function renderSteamInformations(steamData) {
  const infoList = document.querySelector(
    ".productInformations .informations ul"
  );

  if (!infoList) {
    console.warn("Bloc .informations introuvable dans le DOM.");
    return;
  }

  // On vide tout sauf le <h3> Informations
  infoList.innerHTML = "<h3>Informations</h3>";

  // Date de sortie
  if (steamData.release_date && steamData.release_date.date) {
    const li = document.createElement("li");
    li.innerHTML = `<strong>Date de sortie :</strong> ${steamData.release_date.date}`;
    infoList.appendChild(li);
  }

  // Éditeurs
  if (steamData.publishers && steamData.publishers.length > 0) {
    const li = document.createElement("li");
    li.innerHTML = `<strong>Éditeur(s) :</strong> ${steamData.publishers.join(
      ", "
    )}`;
    infoList.appendChild(li);
  }

  // Genres
  if (steamData.genres && steamData.genres.length > 0) {
    const li = document.createElement("li");
    const genreList = steamData.genres.map((g) => g.description).join(", ");
    li.innerHTML = `<strong>Genres :</strong> ${genreList}`;
    infoList.appendChild(li);
  }

  // Score Metacritic
  if (steamData.metacritic && steamData.metacritic.score) {
    const li = document.createElement("li");
    li.innerHTML = `<strong>Score Metacritic :</strong> ${steamData.metacritic.score}/100`;
    infoList.appendChild(li);
  }

  // Recommandations / avis Steam
  if (steamData.recommendations && steamData.recommendations.total) {
    const li = document.createElement("li");
    li.innerHTML = `<strong>Évaluations Steam :</strong> ${steamData.recommendations.total.toLocaleString()} avis`;
    infoList.appendChild(li);
  }
}

/**
 * Injecte la description, la bande-annonce et les captures d'écran du jeu.
 * @param {Object} steamData - Données multimédia issues de Steam.
 */
function renderSteamMedia(steamData) {
  // Description
  const descBlock = document.querySelector(".description");
  if (descBlock && steamData.about_the_game) {
    descBlock.innerHTML = steamData.about_the_game;
  }

  // Sélectionne les éléments vidéo
  const videoBlock = document.querySelector(".videos");
  const videoElement = videoBlock?.querySelector("video");
  const trailerSource = videoElement?.querySelector("source");

  if (
    videoBlock &&
    videoElement &&
    trailerSource &&
    steamData.movies &&
    steamData.movies.length > 0
  ) {
    const videoUrl = steamData.movies[0].webm.max.replace(/^http:/, "https:");
    trailerSource.src = videoUrl;
    videoElement.load(); // Recharge la source
  } else {
    if (videoBlock) videoBlock.style.display = "none";
  }

  // Screenshots
  const gallery = document.querySelector(".screenshotsGallery");
  if (gallery && steamData.screenshots && steamData.screenshots.length > 0) {
    gallery.innerHTML = ""; // Nettoyage

    steamData.screenshots.forEach((shot, index) => {
      const img = document.createElement("img");
      img.src = shot.path_thumbnail;
      img.dataset.full = shot.path_full;
      img.dataset.index = index;
      img.className = "screenshotThumb";
      img.alt = "Screenshot";

      gallery.appendChild(img);
    });
    addLightbox();
  }
}

/**
 * Système de lightbox pour l'affichage des captures d'écran en grand format.
 */
function addLightbox() {
  const thumbs = document.querySelectorAll(".screenshotThumb");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImage");
  const prevBtn = document.getElementById("prev");
  const nextBtn = document.getElementById("next");
  const closeLightboxBtn = document.querySelector(".lightbox .close");

  let currentIndex = 0;
  const fullImages = Array.from(thumbs).map((img) => img.dataset.full);

  // Affiche une image dans la lightbox
  function showLightbox(index) {
    currentIndex = index;
    lightboxImg.src = fullImages[currentIndex];
    lightbox.classList.remove("hidden");
  }

  // Événements pour les miniatures
  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      const index = parseInt(thumb.dataset.index);
      showLightbox(index);
    });
  });

  // Ferme la lightbox si clic à l’extérieur
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.add("hidden");
    }
  });

  // Navigation avec les flèches
  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + fullImages.length) % fullImages.length;
    showLightbox(currentIndex);
  });

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % fullImages.length;
    showLightbox(currentIndex);
  });

  // Navigation clavier
  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("hidden")) {
      if (e.key === "ArrowLeft") prevBtn.click();
      if (e.key === "ArrowRight") nextBtn.click();
      if (e.key === "Escape" && closeLightboxBtn) closeLightboxBtn.click();
    }
  });
}

/**
 * Gère l’ajout manuel d’un jeu aux offres en vedette (admin only).
 * @param {string} steamId
 * @param {string} apiId
 * @param {string} title
 */
function addFeaturedOfferButton(steamId, apiId, title) {
  const button = document.getElementById("featuredOfferBtn");

  if (!button) return;

  button.addEventListener("click", () => {
    fetch("?action=addFeaturedOffer", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        steam_id: steamId,
        api_id: apiId,
        game_title: title,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) showMessage("Ajouté à la sélection !", "success");
        else showMessage("Erreur : " + data.message, "error");
      })
      .catch(() => showMessage("Erreur réseau", "error"));
  });
}

/**
 * Supprime les sections dépendantes des données Steam si absentes.
 */
function cleanDom() {
  const selectors = [
    ".headerImageWrapper",
    ".productInformations",
    "#descriptionTitle",
    ".description",
    ".medias",
    ".disclaimer",
  ];

  selectors.forEach((selector) => {
    document.querySelectorAll(selector).forEach((el) => {
      el.style.display = "none";
    });
  });

  const overlays = document.querySelectorAll(".overlayContent");

  overlays.forEach((el) => {
    el.style.position = "relative";
  });
}

/**
 * Ajoute le jeux en favoris pour l'utilisateur (users only).
 */
function addFavorite(gameId) {
  const button = document.getElementById("favoriteBtn");

  if (!button) return;

  button.addEventListener("click", () => {
    fetch("?action=favorite", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        game_id: gameId,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) showMessage(data.message, "success");
        else showMessage("Erreur : " + data.message, "error");
      })
      .catch(() => showMessage("Erreur réseau", "error"));
  });
}