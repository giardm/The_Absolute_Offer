/**
 * ============================================
 * Register Form Handler – Formulaire d'inscription utilisateur
 * --------------------------------------------
 * Comportement :
 * - Validation front-end (email, mots de passe)
 * - Soumission via Fetch (AJAX)
 * - Toasts dynamiques avec redirection vers login
 * ============================================
 */

import { showMessage } from "./messageDisplay.js"; // Affichage des messages d’état (toast)

/**
 * Initialisation du formulaire d'inscription après chargement du DOM.
 * Attache un gestionnaire d’événement à la soumission du formulaire.
 */
document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("registerForm")
    .addEventListener("submit", registerStatus);
});

/**
 * Gère la soumission du formulaire d'inscription.
 * Valide les champs côté client puis envoie la requête d'inscription via Fetch.
 * Affiche un message d’état via showMessage() et redirige vers la page de login en cas de succès.
 * @param {Event} e - L'événement déclenché à la soumission du formulaire
 */
async function registerStatus(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  const email = formData.get("email")?.trim();
  const username = formData.get("username")?.trim();
  const password = formData.get("password")?.trim();
  const confirmPassword = formData.get("confirmPassword")?.trim();

  /**
   * Étapes de validation côté client :
   * - Tous les champs doivent être remplis
   * - Email doit être valide
   * - Mot de passe doit faire au moins 6 caractères
   * - Les deux mots de passe doivent correspondre
   */

  if (!email || !username || !password || !confirmPassword) {
    showMessage("Tous les champs doivent être remplis.", "warning");
    return;
  }

  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showMessage("Adresse email invalide.", "warning");
    return;
  }

  if (password.length < 6) {
    showMessage(
      "Le mot de passe doit contenir au moins 6 caractères.",
      "warning"
    );
    return;
  }

  if (password !== confirmPassword) {
    showMessage("Les mots de passe ne correspondent pas.", "warning");
    return;
  }

  /**
   * Envoi de la requête d'inscription au serveur
   */
  try {
    const res = await fetch("?action=register", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    if (data.success) {
      showMessage(data.message, "success");

      // Redirection vers la page de connexion après succès
      setTimeout(() => {
        window.location.href = "?action=login";
      }, 1000);
    } else {
      showMessage(data.message, "warning");
    }
  } catch (err) {
    console.error("Erreur lors de la requête d'inscription :", err);
    showMessage("Erreur réseau lors de l'inscription", "error");
  }
}
