// barre de recherche
const searchInput = document.getElementById("gameSearchInput");
searchInput.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    let query = searchInput.value.trim().toLowerCase().replace(/\s+/g, '');
    if (query.length > 0) {
      window.location.href = `?action=search&query=${encodeURIComponent(query)}`;
    }
  }
});