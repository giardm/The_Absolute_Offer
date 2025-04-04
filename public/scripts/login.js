import { showMessage } from "./messageDisplay.js";

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("loginForm").addEventListener("submit", displayLoginStatus);
});

/**
 * Gère la soumission du formulaire de connexion via fetch.
 * Affiche un toast en cas de succès ou d’erreur.
 * @param {Event} e
 */
async function displayLoginStatus(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  try {
    const res = await fetch("?action=login", {
      method: "POST",
      body: formData
    });

    const data = await res.json();

    if (data.success) {
      showMessage("Connexion réussie !", "success");

      setTimeout(() => {
        window.location.href = "?action=home";
      }, 1000);
    } else {
      showMessage(data.message || "Identifiants incorrects", "warning");
    }
  } catch (err) {
    console.error(err);
    showMessage("Erreur réseau lors de la connexion", "error");
  }
}
