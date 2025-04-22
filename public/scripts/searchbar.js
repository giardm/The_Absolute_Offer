/**
 * ============================================
 * Game Search Input – Déclenchement par touche "Entrée"
 * --------------------------------------------
 * Comportement :
 * - Récupère le champ de recherche de jeu
 * - Sur appui de "Entrée", redirige vers la page de résultats
 * - Nettoie et encode la requête pour l’URL
 * ============================================
 */


/**
 * ============================================
 * Initialisation – Quand le DOM est prêt
 * ============================================
 */
document.addEventListener("DOMContentLoaded", () => {
  initSearchRedirect();
  initMobileSearchToggle();
});

function initSearchRedirect() {
  /**
   * Récupère l’élément du champ texte de recherche.
   * @type {HTMLInputElement}
   */
  const searchInput = document.getElementById("gameSearchInput");

  if (!searchInput) return;

  /**
   * Attache un écouteur clavier pour détecter l’appui sur la touche "Entrée".
   * Si la requête est valide, déclenche une redirection vers la page de résultats.
   * @param {KeyboardEvent} e - Événement déclenché lors de l’appui sur une touche
   */
  searchInput.addEventListener("keydown", function (e) {
    // Si la touche pressée est "Enter"
    if (e.key === "Enter") {
      /**
       * Traitement de la saisie :
       * - trim() : supprime les espaces en début/fin
       * - toLowerCase() : uniformise la casse
       * - replace(/\s+/g, '') : retire tous les espaces internes
       */
      let query = searchInput.value.trim().toLowerCase().replace(/\s+/g, "");

      // Si la requête est non vide, redirige vers les résultats
      if (query.length > 0) {
        const encoded = encodeURIComponent(query);
        window.location.href = `?action=search&query=${encoded}`;
      }
    }
  });
}

/**
 * ============================================
 * Mobile Search Toggle – Affichage barre de recherche
 * --------------------------------------------
 * Comportement :
 * - Récupère le bouton et la barre de recherche
 * - Au clic sur la loupe mobile, affiche/masque l’input
 * - Met automatiquement le focus pour afficher le clavier
 * ============================================
 */
function initMobileSearchToggle() {
  const toggleButton = document.getElementById('mobileSearchToggle');
  const searchContainer = document.querySelector('.searchContainer');
  const searchInput = document.getElementById('gameSearchInput');
  const logo = document.getElementById('mobileLogo');
  const login = document.getElementById('loginIcon');

  if (!toggleButton || !searchContainer || !searchInput || !logo || !login) return;

  // Clic sur la loupe : affiche la barre et cache les icônes
  toggleButton.addEventListener('click', () => {
    searchContainer.classList.add('show');
    logo.classList.add('hidden');
    login.classList.add('hidden');

    setTimeout(() => {
      searchInput.focus();
    }, 100);
  });

  // Quand l'input perd le focus : revenir à l'état initial
  searchInput.addEventListener('blur', () => {
    searchContainer.classList.remove('show');
    logo.classList.remove('hidden');
    login.classList.remove('hidden');
  });
}



