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
  const openBtns = document.querySelectorAll(".openOffersOverlay");

  openBtns.forEach((btn) => {
    btn.addEventListener("click", async () => {
      const gameId = btn.dataset.gameId;
      const overlay = document.querySelector(`.offersOverlay[data-game-id="${gameId}"]`);

      if (!overlay) return;

      overlay.style.display = "block";

      const offerList = overlay.querySelector(".offerList");
      offerList.innerHTML = "";

      try {
        const [storeMap, gameData] = await Promise.all([
          getStoresList(),
          fetch(`https://www.cheapshark.com/api/1.0/games?id=${gameId}`).then(res => res.json())
        ]);

        gameData.deals.forEach((deal) => {
          const store = storeMap[deal.storeID];
          const offerEl = createOffer(deal, store);
          offerList.appendChild(offerEl);
        });

        addSavingscolors();

        if (gameData.deals.length === 0) {
          offerList.innerHTML = `<li>Aucune offre trouvée pour ce jeu.</li>`;
        }
      } catch (err) {
        console.error("Erreur lors du chargement des offres :", err);
        offerList.innerHTML = `<li>Erreur de chargement des offres</li>`;
      }

      const closeBtn = overlay.querySelector(".closeOffersOverlay");
      if (closeBtn) {
        closeBtn.addEventListener("click", () => {
          overlay.style.display = "none";
        });
      }

      const overlayContent = overlay.querySelector(".overlayContent");
      overlay.addEventListener("click", (e) => {
        if (!overlayContent.contains(e.target)) {
          overlay.style.display = "none";
        }
      });
    });
  });
}

/**
 * Applique des classes CSS sur les offres en fonction de leur niveau de réduction.
 * Permet de colorer les pourcentages selon un gradient de quartiles.
 */
export function addSavingscolors() {
  const savingsElements = document.querySelectorAll(".discount");
  const savingsValues = Array.from(savingsElements).map((el) =>
    parseFloat(el.dataset.savings)
  );

  if (savingsValues.length > 0) {
    const min = Math.min(...savingsValues);
    const max = Math.max(...savingsValues);
    const range = max - min;

    const q1 = min + range * 0.25;
    const q2 = min + range * 0.5;
    const q3 = min + range * 0.75;

    savingsElements.forEach((el) => {
      const val = parseFloat(el.dataset.savings);
      let className = "";

      if (val <= q1) className = "q1";
      else if (val <= q2) className = "q2";
      else if (val <= q3) className = "q3";
      else className = "q4";

      el.classList.add(className);
    });
  }
}

