// Attend que le contenu HTML de la page soit complètement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", () => {

  // Envoie une requête pour récupérer les offres en vedette depuis un fichier PHP
  fetch("../app/models/getFeaturedOffers.php")
    .then((response) => response.json()) // Convertit la réponse en JSON
    .then((data) => { // Une fois les données reçues et converties

      // Récupère l'élément HTML qui contiendra les cartes de jeux
      const container = document.getElementById("featuredGamesContainer");
      container.innerHTML = ""; // Vide le conteneur au cas où il aurait déjà du contenu

      // Parcourt chaque élément (jeu) dans les données reçues
      data.forEach((item) => {
        const steamId = item.steam_id; // Récupère l'identifiant Steam du jeu
        const apiId = item.api_id;     // Récupère l'identifiant interne pour la redirection

        // Construit l'URL de l'image du jeu à partir de l'ID Steam
        const imageUrl = `https://cdn.akamai.steamstatic.com/steam/apps/${steamId}/library_600x900.jpg`;

        // Crée un nouvel élément HTML pour représenter une carte de jeu
        const card = document.createElement("div");
        card.classList.add("gameCard"); // Ajoute une classe CSS pour le style

        // Définit le contenu HTML de la carte avec un lien vers la page produit et l'image du jeu
        card.innerHTML = `
        <a href="?action=product&id=${apiId}"><img src="${imageUrl}" alt="Game ${steamId}"></a>
      `;

        // Ajoute la carte au conteneur dans le DOM
        container.appendChild(card);
      });
    })
    // En cas d'erreur lors du chargement ou du traitement des données
    .catch((error) => console.error("Error loading games:", error));
});







