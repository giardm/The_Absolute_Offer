/**
 * ============================================
 * Login Form Handler – Connexion utilisateur
 * --------------------------------------------
 * Comportement :
 * - Soumission du formulaire de connexion via AJAX
 * - Affichage dynamique du statut via toast message
 * - Redirection automatique en cas de succès
 * ============================================
 */

import { showMessage } from "./messageDisplay.js"; // Utilitaire pour affichage de messages toast

/**
 * Point d’entrée principal : attend que le DOM soit entièrement chargé.
 * Attache un écouteur de soumission au formulaire de connexion.
 */
document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");

  if (loginForm) {
    // Met le focus sur le premier champ du formulaire
    const firstInput = loginForm.querySelector("input, select, textarea, button");
    if (firstInput) {
      firstInput.focus();
    }

    loginForm.addEventListener("submit", displayLoginStatus);
  }
});


/**
 * Gère la soumission du formulaire de connexion.
 * Envoie les données d'identification à l'API (login) via `fetch`.
 * Affiche un message de retour (succès ou erreur) et redirige en cas de succès.
 *
 * @param {Event} e - Événement de soumission du formulaire
 * @returns {Promise<void>}
 */
async function displayLoginStatus(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  try {
    // Envoi de la requête POST avec les identifiants utilisateur
    const res = await fetch("?action=login", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    // Si authentification réussie, afficher toast + rediriger
    if (data.success) {
      showMessage(data.message, "success");

      setTimeout(() => {
        window.location.href = "?action=home";
      }, 1000);
    } else {
      // Affiche un message d'avertissement en cas d'échec
      showMessage(data.message, "warning");
    }
  } catch (err) {
    console.error("Erreur lors de la tentative de connexion :", err);
    showMessage("Erreur réseau lors de la connexion", "error");
  }
}
