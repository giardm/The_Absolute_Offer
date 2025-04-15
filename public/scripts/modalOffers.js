/**
 * Crée dynamiquement un élément HTML <li> représentant une offre.
 * @param {Object} deal - Données de l'offre (prix, savings, dealID...).
 * @param {Object} store - Données du magasin (nom, logo).
 * @returns {HTMLElement} - Élément <li> prêt à être inséré dans le DOM.
 */

export function createOffer(deal, store) {
  const savings = Math.round(deal.savings);
  const dealUrl = `https://www.cheapshark.com/redirect?dealID=${deal.dealID}`;

  const li = document.createElement("li");
  li.className = "offerItem";

  const link = document.createElement("a");
  link.className = "offerCard";
  link.href = dealUrl;
  link.target = "_blank";
  link.rel = "noopener noreferrer";

  // Logo du store
  if (store.logo) {
    const img = document.createElement("img");
    img.className = "storeLogo";
    img.src = store.logo;
    img.alt = store.name;
    link.appendChild(img);
  }

  // Détails de l'offre
  const infoDiv = document.createElement("div");
  infoDiv.className = "offerInfo";

  const nameP = document.createElement("p");
  nameP.className = "storeName";
  nameP.textContent = store.name;

  const priceP = document.createElement("p");
  priceP.className = "price";
  priceP.textContent = `${deal.price} €`;

  const discountSpan = document.createElement("span");
  discountSpan.className = "discount";
  discountSpan.dataset.savings = savings;
  discountSpan.textContent = `-${savings}%`;

  // Assemblage des éléments
  infoDiv.appendChild(nameP);
  infoDiv.appendChild(priceP);
  infoDiv.appendChild(discountSpan);
  link.appendChild(infoDiv);
  li.appendChild(link);

  return li;
}

/**
 * Récupère la liste des magasins disponibles via CheapShark.
 * @returns {Promise<Object>} - Mapping storeID => {name, logo}
 */
export async function getStoresList() {
  const storeMap = {};
  const res = await fetch("https://www.cheapshark.com/api/1.0/stores");
  const stores = await res.json();

  stores.forEach((store) => {
    storeMap[store.storeID] = {
      name: store.storeName,
      logo: "https://www.cheapshark.com" + store.images.logo,
    };
  });

  return storeMap;
}

/**
 * Gère l'ouverture et la fermeture de la modale contenant toutes les offres.
 * Active les interactions liées à l'overlay.
 */
export function createModal() {
  const openBtn = document.querySelector('[data-game-id]');
  const closeBtn = document.querySelector(".closeOffersOverlay");
  const overlay = document.querySelector(".offersOverlay");
  const overlayContent = overlay.querySelector(".overlayContent");

  if (openBtn) {
    openBtn.addEventListener("click", () => {
      overlay.style.display = "block";
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", () => {
      overlay.style.display = "none";
    });
  }

  overlay.addEventListener("click", (e) => {
    if (!overlayContent.contains(e.target)) {
      overlay.style.display = "none";
    }
  });
}