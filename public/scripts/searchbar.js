// Récupère l'élément input de recherche (champ texte)
const searchInput = document.getElementById("gameSearchInput");

// Ajoute un écouteur sur l'événement "keydown" (touche enfoncée)
searchInput.addEventListener("keydown", function (e) {
  // Vérifie si l'utilisateur a appuyé sur la touche "Entrée"
  if (e.key === "Enter") {
    // Récupère la valeur saisie, enlève les espaces, convertit en minuscule, supprime les espaces internes
    let query = searchInput.value.trim().toLowerCase().replace(/\s+/g, '');

    // Si la requête n'est pas vide
    if (query.length > 0) {
      // Redirige vers la page de recherche avec la requête encodée dans l'URL
      window.location.href = `?action=search&query=${encodeURIComponent(query)}`;
    }
  }
});
