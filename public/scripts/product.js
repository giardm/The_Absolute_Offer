// Exécute le code une fois que le DOM est entièrement chargé
document.addEventListener('DOMContentLoaded', function () {
  // Bouton pour ouvrir la modale
  const openBtn = document.getElementById('openOffersOverlay');
  // Bouton pour fermer la modale
  const closeBtn = document.getElementById('closeOffersOverlay');
  // L'élément de superposition (modale)
  const overlay = document.getElementById('offersOverlay');
  // Le contenu interne de la modale
  const overlayContent = overlay.querySelector('.overlayContent');

  // Si le bouton d'ouverture existe, on lui ajoute un événement "click"
  if (openBtn) {
    openBtn.addEventListener('click', () => {
      overlay.style.display = 'block'; // Affiche la modale
    });
  }

  // Si le bouton de fermeture existe, on lui ajoute un événement "click"
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      overlay.style.display = 'none'; // Cache la modale
    });
  }

  // Ferme la modale si on clique en dehors du contenu
  overlay.addEventListener('click', function (e) {
    if (!overlayContent.contains(e.target)) {
      overlay.style.display = 'none'; // Cache la modale
    }
  });
});


// Récuperer les informations sur les differents stores
fetch('https://www.cheapshark.com/api/1.0/stores')
  .then(response => response.json())
  .then(data => {
    const storeList = {};

    data.forEach(store => {
      storeList[store.storeID] = {
        name: store.storeName,
        logo: 'https://www.cheapshark.com' + store.images.logo
      };
    });
  })

  .catch(error => {
    console.error('Erreur lors de la récupération des stores :', error);
  });



document.addEventListener("DOMContentLoaded", () => {
  // Miniatures d’images
  const thumbs = document.querySelectorAll(".screenshotThumb");
  const lightbox = document.getElementById("lightbox"); // conteneur lightbox
  const lightboxImg = document.getElementById("lightboxImage"); // image en plein écran
  const closeBtn = document.querySelector(".lightbox .close"); // bouton de fermeture
  const prevBtn = document.getElementById("prev"); // bouton image précédente
  const nextBtn = document.getElementById("next"); // bouton image suivante

  let currentIndex = 0; // index de l’image affichée
  // Liste des URLs d’images en grand format
  const fullImages = Array.from(thumbs).map(img => img.dataset.full);

  // Affiche l’image dans la lightbox
  function showLightbox(index) {
    currentIndex = index;
    lightboxImg.src = fullImages[currentIndex];
    lightbox.classList.remove("hidden"); // Affiche la lightbox
  }

  // Clique sur une miniature : ouvre la lightbox avec l’image correspondante
  thumbs.forEach(thumb => {
    thumb.addEventListener("click", () => {
      const index = parseInt(thumb.dataset.index);
      showLightbox(index);
    });
  });

  // Ferme la lightbox si on clique en dehors de l’image
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.add("hidden");
    }
  });

  // Navigue vers l’image précédente
  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + fullImages.length) % fullImages.length;
    showLightbox(currentIndex);
  });

  // Navigue vers l’image suivante
  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % fullImages.length;
    showLightbox(currentIndex);
  });

  // Navigation au clavier
  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("hidden")) {
      if (e.key === "ArrowLeft") prevBtn.click();     // flèche gauche
      if (e.key === "ArrowRight") nextBtn.click();     // flèche droite
      if (e.key === "Escape") closeBtn.click();        // touche Échap
    }
  });
});


document.addEventListener("DOMContentLoaded", () => {
  // Sélectionne tous les éléments ayant un pourcentage d’économie
  const savingsElements = document.querySelectorAll(".discount[data-savings]");
  const savingsValues = Array.from(savingsElements).map(el => parseFloat(el.dataset.savings));

  if (savingsValues.length === 0) return; // Si pas d’économie, on sort

  // Calcule les valeurs min, max et les quartiles
  const min = Math.min(...savingsValues);
  const max = Math.max(...savingsValues);
  const range = max - min;

  const q1 = min + range * 0.25;
  const q2 = min + range * 0.5;
  const q3 = min + range * 0.75;

  // Pour chaque élément, on lui applique une classe CSS selon sa position dans les quartiles
  savingsElements.forEach(el => {
    const val = parseFloat(el.dataset.savings);
    let className = "";

    if (val <= q1) className = "q1";     // Économie faible
    else if (val <= q2) className = "q2";
    else if (val <= q3) className = "q3";
    else className = "q4";               // Économie forte

    el.classList.add(className); // Ajoute la classe CSS
  });
});
