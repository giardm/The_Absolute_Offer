const sliderWrapper = document.querySelector(".sliderWrapper");

// Fonction utilitaire pour calculer dynamiquement la largeur d'une slide
function getSlideWidth() {
  const slide = sliderWrapper.querySelector(".slide");
  const style = getComputedStyle(slide);
  const margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight);
  return slide.offsetWidth + margin;
}

// Fonction qui applique les classes d'état (active, next, etc.)
function updateSlideClasses() {
  const slides = sliderWrapper.querySelectorAll(".slide");

  slides.forEach((slide) => {
    slide.classList.remove("active", "prev", "next", "prev2", "next2");
  });

  if (slides.length >= 5) {
    slides[0].classList.add("prev2");
    slides[1].classList.add("prev");
    slides[2].classList.add("active");
    slides[3].classList.add("next");
    slides[4].classList.add("next2");
  }
}

// Fonction principale : fait glisser le slider vers la gauche avec effet smooth
function slideNext() {
  const width = getSlideWidth();

  // en déplaçant le dernier élément au tout début SANS transition
  sliderWrapper.style.transition = "none";
  sliderWrapper.insertBefore(
    sliderWrapper.lastElementChild,
    sliderWrapper.firstElementChild
  );

  // On positionne le wrapper légèrement à gauche pour que ça ait l'air naturel
  sliderWrapper.style.transform = `translateX(-${width}px)`;

  // Met à jour les classes pendant le mouvement
  updateSlideClasses();

  // Ensuite, on déclenche la vraie animation vers 0
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      sliderWrapper.style.transition = "transform 0.5s ease";
      sliderWrapper.style.transform = "translateX(0)";
    });
  });
}

// Lance l'animation toutes les 3 secondes
setInterval(slideNext, 3000);

// Initialisation au chargement
updateSlideClasses();
