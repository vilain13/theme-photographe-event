console.log("Bonjour front-page.js");
document.addEventListener("DOMContentLoaded", function() {
  

    // Code JavaScript pour gérer les filtres et charger les images sur la page d'accueil front-page.php
    jQuery(document).ready(function ($) {
        


        // Fonction pour charger les images en fonction des filtres
        function loadImages(category, format, sortOrder) {
            $.ajax({
                url: './wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'fetch_filtered_images',
                    category: category,
                    format: format,
                    sort_order: sortOrder,
                 
                },
                success: function (response) {
                    var images = JSON.parse(response);
                    var imageContainer = $('#image-container');
                    imageContainer.empty();

                    $.each(images, function (index, imageData) {
                        // Créer un article pour chaque image
                        var imageArticle = $('<article>').addClass('photo');

                        // Créer un lien vers la page du post de l'image
                        var imageLink = $('<a class="rollover-eye fa-solid fa-eye fa-2xl">').attr('href', imageData.post_url);

                        // Créer l'élément d'image avec la classe img-fluid et ajoutez l'URL de l'image
                        var imageElement = $('<img>').addClass('img-fluid').attr('src', imageData.image_url);

                        // Créer des éléments pour afficher les valeurs de catégorie et de format au survol
                        let categoryValues = imageData.category.map(function (category) {
                            return category.name;
                        });
                        let formatsValues = imageData.formats.map(function (format) {
                            return format.name;
                        });
                    
                        let categoryLabel = $('<span>').addClass('rollover-category').text(categoryValues);
                        let formatLabel = $('<span>').addClass('rollover-format').text(formatsValues);

                        // Créer l'element pour l'icone Plein ecran
                        let fullscreenIcon = $('<span>').addClass('rollover-fullscreen fa-solid fa-expand fa-2xl');

                        // Envelopper l'image et les labels dans une div de conteneur
                        var imageContainerDiv = $('<div>').addClass('rollover-image'); 


                        // Envelopper les elements icones et infos  Rollover dans la div conteneur
                        imageContainerDiv.append(categoryLabel, formatLabel, fullscreenIcon, imageLink);

                        // Ajouter  la div conteneur   (  pour elements rollove ) et l'image à l'article 
                        imageArticle.append(imageContainerDiv, imageElement); 

                        // Ajouter l'article au conteneur   
                        imageContainer.append(imageArticle);

                        
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Récupérer les valeurs des filtres au chargement de la page (pour afficher toutes les images sans filtre)
        var category = $('#category-filter').val();
        var format = $('#format-filter').val();
        var sortOrder = $('#sort-order').val();

        // Appeler la fonction de chargement des images au chargement initial de la page avec les filtres récupérés
        loadImages(category, format, sortOrder);

        // Appeler la fonction de chargement des images lorsque les filtres ou le tri changent
        $('#category-filter, #format-filter, #sort-order').change(function () {
            var category = $('#category-filter').val();
            var format = $('#format-filter').val();
            var sortOrder = $('#sort-order').val();
            loadImages(category, format, sortOrder);
        });
    });

});




