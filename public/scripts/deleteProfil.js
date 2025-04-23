import { showMessage } from "./messageDisplay.js"; // Affichage des messages d’état (toast)

document.addEventListener("DOMContentLoaded", () => {
  const confirmBtn = document.getElementById("confirm");
  const cancelBtn = document.getElementById("cancel");

  if (confirmBtn) {
    confirmBtn.addEventListener("click", deleteAccount);
  }

  if (cancelBtn) {
    cancelBtn.addEventListener("click", (e) => {
      e.preventDefault();
      if (document.referrer) {
        window.history.back();
      } else {
        window.location.href = "?action=home";
      }
    });
  }
});

async function deleteAccount(e) {
  e.preventDefault();
  console.log("un");

  try {
    const res = await fetch("?action=deleteProfil", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await res.json();
    console.log(data);

    if (data.success) {
      showMessage(data.message, "success");
      setTimeout(() => {
        window.location.href = "?action=logout";
      }, 1000);
    } else {
      showMessage(data.message, "warning");
    }
  } catch (err) {
    showMessage("Erreur réseau", "error");
  }
}
