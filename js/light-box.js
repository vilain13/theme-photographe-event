
document.addEventListener("DOMContentLoaded", function() {
    
    // Déclaration des variables pour la gestion de la Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImages = document.getElementById('lightbox-images');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCategory = document.getElementById('lightbox-category');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxLink =  document.getElementById('lightbox-image-link'); 
    const lightboxClose = document.getElementById('lightbox-close');
    const nextButton = document.getElementById('next-button');
    const prevButton = document.getElementById('prev-button');
    let currentImageIndex = 0;

    // Créer un tableau d'associations pour faire correspondre les ID et les images
    const idToImage = {};

    // Récupérer les images de WordPress triées par ID
    const imagesFromWordPress = imageData;

    // Ajouter les images au tableau idToImage en utilisant l'ID de post
    imagesFromWordPress.forEach((image, index) => {
        const lightboxItemId = image.ID.toString();
        idToImage[lightboxItemId] = index;
    });

    // Ouverture de la Lightbox avec affichage de l'image cliquée 
    function openLightbox(lightboxItemId) {
        const index = idToImage[lightboxItemId];
        if (index !== undefined) {
            currentImageIndex = index;
            showImage(currentImageIndex);
            lightbox.style.display = 'block';
        }
    }

    function showImage(index) {
        const images = lightboxImages.querySelectorAll('.lightbox-item img');
        if (images[index]) {
            lightboxImage.src = images[index].src;
            lightboxCategory.textContent = images[index].getAttribute('data-category');
            lightboxTitle.textContent = images[index].getAttribute('title');
            lightboxLink.href = images[index].getAttribute('post-link'); 
            currentImageIndex = index;
        }
    }

    // Fermeture de la lightBox
    function closeLightbox() {
        lightbox.style.display = 'none';
    }

    // Changement de slide avec navigation perpetuelle
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

    // Déclenchement des fonctions aux événements click
    lightboxClose.addEventListener('click', closeLightbox);
    nextButton.addEventListener('click', () => changeImage(1));
    prevButton.addEventListener('click', () => changeImage(-1));

    // Gestionnaire d'événements pour les éléments rollover-fullscreen  ( récupération de l'ID  de l'image cliquée dans template photo-block)
    const rolloverFullscreenElements = document.querySelectorAll('.rollover-fullscreen');

    for (const element of rolloverFullscreenElements) {
        element.addEventListener('click', function() {
            const lightboxItemId = this.getAttribute('data-lightbox-item-id');
            openLightbox(lightboxItemId);
        });
    }
});






