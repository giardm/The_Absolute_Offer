import { showMessage } from "./messageDisplay.js";

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("registerForm")
    .addEventListener("submit", registerStatus);
});

/**
 * Gère la soumission du formulaire d'inscription via fetch.
 * Affiche un toast en cas de succès ou d’erreur.
 * @param {Event} e
 */
async function registerStatus(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  const email = formData.get("email")?.trim();
  const username = formData.get("username")?.trim();
  const password = formData.get("password")?.trim();
  const confirmPassword = formData.get("confirmPassword")?.trim();

  // Vérif des champs vides
  if (!email || !username || !password || !confirmPassword) {
    showMessage("Tous les champs doivent être remplis.", "warning");
    return;
  }

  // Vérif email
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showMessage("Adresse email invalide.", "warning");
    return;
  }

  // Vérif mot de passe longueur
  if (password.length < 6) {
    showMessage(
      "Le mot de passe doit contenir au moins 6 caractères.",
      "warning"
    );
    return;
  }

  // Vérif correspondance
  if (password !== confirmPassword) {
    showMessage("Les mots de passe ne correspondent pas.", "warning");
    return;
  }

  try {
    const res = await fetch("?action=register", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    if (data.success) {
      showMessage(data.message, "success");
      setTimeout(() => {
        window.location.href = "?action=login";
      }, 1000);
    } else {
      showMessage(data.message, "warning");
    }
  } catch (err) {
    console.error(err);
    showMessage("Erreur réseau lors de l'inscription", "error");
  }
}
