console.log("Bonjour lightbox JS");
document.addEventListener("DOMContentLoaded", function() {
 

// Déclaration des variables pour la gestion de la Lightbox
const lightbox = document.getElementById('lightbox');
const lightboxImages = document.getElementById('lightbox-images');
const lightboxImage = document.getElementById('lightbox-image');
const lightboxCategory = document.getElementById('lightbox-category');
const lightboxReference = document.getElementById('lightbox-reference');
const lightboxClose = document.getElementById('lightbox-close');
const nextButton = document.getElementById('next-button');
const prevButton = document.getElementById('prev-button');
let currentImageIndex = 0;

// Ouverture de la Lightbox

function openLightbox(lightboxItemId) {
    currentImageIndex = 0;
    showImage(currentImageIndex);
    lightbox.style.display = 'block';
}

function showImage(index) {
    const images = lightboxImages.querySelectorAll('.lightbox-item img');
    if (images[index]) {
        lightboxImage.src = images[index].src;
        lightboxCategory.textContent = images[index].getAttribute('data-category');
        lightboxReference.textContent = images[index].getAttribute('alt');
        currentImageIndex = index;
    }
}

// Fermeture de la lightBox

function closeLightbox() {
    lightbox.style.display = 'none';
}


// Changement de slide avec  navigation permetuelle

function changeImage(offset) {
  const newIndex = currentImageIndex + offset;

  // Si newIndex est supérieur à la dernière image, revenez à la première
  if (newIndex >= lightboxImages.childElementCount) {
      currentImageIndex = 0;
  }
  // Si newIndex est inférieur à la première image, passez à la dernière
  else if (newIndex < 0) {
      currentImageIndex = lightboxImages.childElementCount - 1;
  }
  // Sinon, affichez l'image normalement
  else {
      currentImageIndex = newIndex;
  }

  showImage(currentImageIndex);
}

//  Declenchement des fonctions  aux evenements click
lightboxClose.addEventListener('click', closeLightbox);
nextButton.addEventListener('click', () => changeImage(1));
prevButton.addEventListener('click', () => changeImage(-1));

// Gestionnaire  d'événements pour les éléments rollover-fullscreen
const rolloverFullscreenElements = document.querySelectorAll('.rollover-fullscreen');

for (const element of rolloverFullscreenElements) {
    element.addEventListener('click', function() {
        const lightboxItemId = this.getAttribute('data-lightbox-item-id');
        openLightbox(lightboxItemId);
    });
}




});


  

