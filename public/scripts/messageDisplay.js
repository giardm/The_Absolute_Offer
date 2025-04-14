/**
 * ============================================
 * Toast Message Utility – Affichage de notifications
 * --------------------------------------------
 * Comportement :
 * - Affiche un message temporaire en haut de l’écran
 * - Applique une animation CSS d’apparition/disparition
 * - Prend en charge plusieurs types : success / error / warning
 * ============================================
 */

/**
 * Affiche un message contextuel animé en haut de l'écran.
 * Utilisé pour fournir un retour utilisateur après une action (formulaire, API, etc.).
 *
 * @param {string} message - Le texte du message à afficher.
 * @param {string} [type="success"] - Type de message :
 *        "success" (vert), "error" (rouge), "warning" (jaune).
 *
 * @example
 * showMessage("Article ajouté avec succès", "success");
 * showMessage("Erreur lors de la connexion", "error");
 */
export function showMessage(message, type = "success") {
  const toast = document.getElementById("messageDisplay");

  // Si l’élément n’existe pas dans le DOM, on quitte sans erreur
  if (!toast) return;

  // Injection du texte + réinitialisation des classes
  toast.textContent = message;
  toast.className = "toast"; // Réinitialise les classes CSS

  // Forcer le reflow pour redémarrer l'animation CSS proprement
  toast.style.display = "block";
  void toast.offsetHeight; // Trick pour forcer un reflow (flush styles)

  // Application de la classe d’animation + style spécifique au type
  toast.classList.add("show", type);

  // Masque automatiquement le message après 3 secondes
  setTimeout(() => {
    toast.classList.remove("show");
  }, 3000);
}
