/**
 * ============================================
 * Article Submission Handler – Formulaire d'ajout d'article
 * --------------------------------------------
 * Comportement :
 * - Gère la soumission d'un formulaire d'article en AJAX (Fetch)
 * - Affiche un message de confirmation via showMessage()
 * - Redirige automatiquement en cas de succès
 * ============================================
 */

import { showMessage } from "./messageDisplay.js"; // Utilitaire d'affichage des messages

/**
 * Point d'entrée principal : attend que le DOM soit chargé,
 * puis attache un écouteur de soumission sur le formulaire d'article.
 */
document.addEventListener("DOMContentLoaded", () => {
  const articleForm = document.getElementById("articleForm");

  if (articleForm) {
    articleForm.addEventListener("submit", submitArticle);
  }
});

/**
 * Gère la soumission du formulaire d’ajout d’article.
 * Envoie les données via `fetch()` en POST vers l’API PHP.
 * Affiche un message de retour (succès / erreur) via showMessage().
 *
 * @param {Event} e - Événement de soumission du formulaire
 * @returns {Promise<void>}
 */
async function submitArticle(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  try {
    // Envoi des données à l’API via POST
    const res = await fetch("?action=addArticle", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    // Traitement de la réponse JSON
    if (data.success) {
      showMessage(data.message, "success");

      // Redirection après succès avec petit délai (UX friendly)
      setTimeout(() => {
        window.location.href = "?action=home";
      }, 1000);
    } else {
      showMessage(data.message, "warning");
    }
  } catch (err) {
    console.error("Erreur lors de la soumission du formulaire :", err);
    showMessage("Erreur réseau lors de l’envoi de l’article", "error");
  }
}
