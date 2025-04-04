/**
 * Affiche un message en haut de l'écran avec animation.
 * @param {string} message - Le texte à afficher.
 * @param {string} type - Le type du message : success, error, warning.
 */
export function showMessage(message, type = "success") {
  const toast = document.getElementById("messageDisplay");
  if (!toast) return;

  toast.textContent = message;
  toast.className = "toast";

  toast.style.display = "block";
  void toast.offsetHeight;

  toast.classList.add("show", type);

  setTimeout(() => {
    toast.classList.remove("show");
  }, 3000);
}

