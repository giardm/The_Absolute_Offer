import { showMessage } from "./messageDisplay.js";

document.addEventListener("DOMContentLoaded", () => {
  const articleForm = document.getElementById("articleForm");
  if (articleForm) {
    articleForm.addEventListener("submit", submitArticle);
  }
});

/**
 * Gère la soumission du formulaire d’article via fetch.
 * Affiche un toast en cas de succès ou d’erreur.
 * @param {Event} e
 */
async function submitArticle(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  try {
    const res = await fetch("?action=addArticle", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    if (data.success) {
      showMessage(data.message, "success");
      setTimeout(() => {
        window.location.href = "?action=home";
      }, 1000);
    } else {
      showMessage(data.message, "warning");
    }
  } catch (err) {
    console.error(err);
    showMessage("Erreur réseau lors de l’envoi de l’article", "error");
  }
}
