//modale offres
document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.getElementById('openOffersOverlay');
  const closeBtn = document.getElementById('closeOffersOverlay');
  const overlay = document.getElementById('offersOverlay');
  const overlayContent = overlay.querySelector('.overlayContent');

  if (openBtn) {
    openBtn.addEventListener('click', () => {
      overlay.style.display = 'block';
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      overlay.style.display = 'none';
    });
  }

  // Clique en dehors de la modale
  overlay.addEventListener('click', function (e) {
    if (!overlayContent.contains(e.target)) {
      overlay.style.display = 'none';
    }
  });
});



// lightbox
document.addEventListener("DOMContentLoaded", () => {
  const thumbs = document.querySelectorAll(".screenshotThumb");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImage");
  const closeBtn = document.querySelector(".lightbox .close");
  const prevBtn = document.getElementById("prev");
  const nextBtn = document.getElementById("next");

  let currentIndex = 0;
  const fullImages = Array.from(thumbs).map(img => img.dataset.full);

  function showLightbox(index) {
    currentIndex = index;
    lightboxImg.src = fullImages[currentIndex];
    lightbox.classList.remove("hidden");
  }

  thumbs.forEach(thumb => {
    thumb.addEventListener("click", () => {
      const index = parseInt(thumb.dataset.index);
      showLightbox(index);
    });
  });

  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.add("hidden");
    }
  });

  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + fullImages.length) % fullImages.length;
    showLightbox(currentIndex);
  });

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % fullImages.length;
    showLightbox(currentIndex);
  });

  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("hidden")) {
      if (e.key === "ArrowLeft") prevBtn.click();
      if (e.key === "ArrowRight") nextBtn.click();
      if (e.key === "Escape") closeBtn.click();
    }
  });
});

//savings
document.addEventListener("DOMContentLoaded", () => {
  const savingsElements = document.querySelectorAll(".discount[data-savings]");
  const savingsValues = Array.from(savingsElements).map(el => parseFloat(el.dataset.savings));

  if (savingsValues.length === 0) return;

  const min = Math.min(...savingsValues);
  const max = Math.max(...savingsValues);
  const range = max - min;

  const q1 = min + range * 0.25;
  const q2 = min + range * 0.5;
  const q3 = min + range * 0.75;

  savingsElements.forEach(el => {
    const val = parseFloat(el.dataset.savings);
    let className = "";

    if (val <= q1) className = "q1";
    else if (val <= q2) className = "q2";
    else if (val <= q3) className = "q3";
    else className = "q4";

    el.classList.add(className);
  });
});