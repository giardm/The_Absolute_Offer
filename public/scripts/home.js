import { initializeCards } from "./profil.js";
import { createModal } from "./modalOffers.js";

/**
 * ============================================
 * Slider Carousel – Défilement horizontal animé
 * --------------------------------------------
 * Comportement :
 * - Slide automatique toutes les 3s
 * - Slide manuel via clavier (← →)
 * - Pause au survol ou interaction utilisateur
 * - Position des slides gérée par classes CSS
 * ============================================
 */

/**
 * Variables globales de contrôle du carrousel.
 */
let autoSlideInterval; // ID de l’intervalle du défilement auto
let isHovered = false; // État de survol de la zone slider
let autoPausedByUser = false; // Indique si un utilisateur a interagi
let userInteractionTimeout; // Timeout pour relancer l'auto-slide après interaction
let sliderWrapper; // Élément DOM contenant les slides (rempli au chargement)

/**
 * Point d’entrée principal : initialise le carrousel une fois le DOM prêt.
 */
document.addEventListener("DOMContentLoaded", () => {
  sliderWrapper = document.querySelector(".sliderWrapper");
  const sliderContainer = document.querySelector(".sliderContainer");

  updateSlideClasses(); // Attribue les classes initiales aux slides
  startAutoSlide(); // Démarre l'animation automatique
  setupMobileCarouselControls(sliderContainer); // Active la navigation du carrousel
  setupHoverPause(); // Active la pause du slider au survol

  const cards = document.querySelectorAll(".favoriteCard");

  initializeCards(cards);
  createModal();
});

/**
 * Calcule dynamiquement la largeur d’une slide,
 * en incluant les marges horizontales.
 *
 * @returns {number} Largeur totale d'une slide en pixels.
 */
function getSlideWidth() {
  const slide = sliderWrapper.querySelector(".slide");
  const style = getComputedStyle(slide);
  const margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight);
  return slide.offsetWidth + margin;
}

/**
 * Applique des classes CSS spécifiques selon la position
 * des slides visibles :
 * - .active : au centre
 * - .prev / .next : adjacentes
 * - .prev2 / .next2 : plus éloignées
 *
 * Utilisé pour les effets de scale, opacité, etc.
 */
function updateSlideClasses() {
  const slides = sliderWrapper.querySelectorAll(".slide");

  slides.forEach((slide) => {
    slide.classList.remove(
      "active",
      "prev",
      "next",
      "prev2",
      "next2",
      "fadeOut"
    );
  });

  if (slides.length >= 5) {
    slides[0].classList.add("prev2");
    slides[1].classList.add("prev");
    slides[2].classList.add("active");
    slides[3].classList.add("next");
    slides[4].classList.add("next2");
  }
}

/**
 * Effectue un glissement vers la droite (visuellement) :
 * - Déplace le dernier élément en tête
 * - Translate le wrapper vers la gauche
 * - Anime le retour à la position neutre
 */
function slideNext() {
  const width = getSlideWidth();

  // Étape 1 : réorganisation DOM (dernier élément → début)
  sliderWrapper.style.transition = "none";
  sliderWrapper.insertBefore(
    sliderWrapper.lastElementChild,
    sliderWrapper.firstElementChild
  );

  // Étape 2 : translation initiale vers la gauche
  sliderWrapper.style.transform = `translateX(-${width}px)`;

  // Étape 3 : mise à jour des classes CSS
  updateSlideClasses();

  // Étape 4 : animation retour vers la position 0
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      sliderWrapper.style.transition = "transform 0.5s ease";
      sliderWrapper.style.transform = "translateX(0)";
    });
  });
}

/**
 * Effectue un glissement vers la gauche (visuellement) :
 * - Déplace le premier élément à la fin
 * - Translate le wrapper vers la droite
 * - Anime le retour à la position neutre
 */
function slidePrev() {
  const width = getSlideWidth();

  // Étape 1 : réorganisation DOM (premier élément → fin)
  sliderWrapper.style.transition = "none";
  sliderWrapper.appendChild(sliderWrapper.firstElementChild);

  // Étape 2 : translation initiale vers la droite
  sliderWrapper.style.transform = `translateX(${width}px)`;

  // Étape 3 : mise à jour des classes CSS
  updateSlideClasses();

  // Étape 4 : animation retour vers la position 0
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      sliderWrapper.style.transition = "transform 0.5s ease";
      sliderWrapper.style.transform = "translateX(0)";
    });
  });
}

/**
 * Démarre le défilement automatique du carrousel
 * avec une fréquence de 3 secondes.
 * Le slide se déclenche uniquement si le curseur
 * n’est pas en survol et si aucune interaction utilisateur récente.
 */
function startAutoSlide() {
  autoSlideInterval = setInterval(() => {
    if (!isHovered && !autoPausedByUser) {
      slideNext();
    }
  }, 3000);
}

/**
 * Met en pause le défilement automatique lorsque
 * l'utilisateur survole la zone du slider.
 */
function setupHoverPause() {
  const container = document.querySelector(".sliderContainer");

  container.addEventListener("mouseenter", () => {
    isHovered = true;
  });

  container.addEventListener("mouseleave", () => {
    isHovered = false;
  });
}

/**
 * Active les contrôles d’interaction manuelle pour un carrousel :
 * - Tactile (mobile) : glisser horizontal pour naviguer
 * - Souris (desktop) : click & drag horizontal
 * - Clavier : flèche droite = slide suivant, flèche gauche = slide précédent
 * Toute interaction manuelle met en pause temporairement l’auto-slide.
 */

function setupMobileCarouselControls(sliderContainer) {
  if (!sliderContainer) return;

  let isDragging = false;
  let startX = 0;
  let currentX = 0;

  sliderContainer.addEventListener("touchstart", (e) => {
    isDragging = true;
    startX = e.touches[0].clientX;
  });

  sliderContainer.addEventListener("touchmove", (e) => {
    if (!isDragging) return;
    currentX = e.touches[0].clientX;
  });

  sliderContainer.addEventListener("touchend", () => {
    if (!isDragging) return;
    const deltaX = currentX - startX;

    if (Math.abs(deltaX) > 50) {
      if (deltaX < 0) {
        slidePrev();
      } else {
        slideNext();
      }
      pauseAutoSlideTemporarily();
    }

    isDragging = false;
  });

  sliderContainer.addEventListener("mousedown", (e) => {
    isDragging = true;
    startX = e.clientX;
    sliderContainer.style.cursor = "grabbing";
  });

  sliderContainer.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    currentX = e.clientX;
  });

  sliderContainer.addEventListener("mouseup", () => {
    if (!isDragging) return;
    const deltaX = currentX - startX;

    if (Math.abs(deltaX) > 50) {
      if (deltaX < 0) {
        slidePrev();
      } else {
        slideNext();
      }
      pauseAutoSlideTemporarily();
    }

    isDragging = false;
    sliderContainer.style.cursor = "grab";
  });

  sliderContainer.addEventListener("mouseleave", () => {
    isDragging = false;
    sliderContainer.style.cursor = "grab";
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowRight") {
      slideNext();
      pauseAutoSlideTemporarily();
    }
    if (e.key === "ArrowLeft") {
      slidePrev();
      pauseAutoSlideTemporarily();
    }
  });

  sliderContainer.style.cursor = "grab";
}




/**
 * Interrompt temporairement le défilement automatique
 * lorsqu'une interaction manuelle a lieu (clavier).
 * Le carrousel redémarre automatiquement après 10 secondes.
 */
function pauseAutoSlideTemporarily() {
  autoPausedByUser = true;

  clearTimeout(userInteractionTimeout); // Réinitialisation si plusieurs interactions

  userInteractionTimeout = setTimeout(() => {
    autoPausedByUser = false;
  }, 10000); // Pause de 10s
}
