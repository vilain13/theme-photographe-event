
document.addEventListener("DOMContentLoaded", function() {

console.log("Bonjour flitres-tri.js");


    jQuery(document).ready(function($) {
        // Écoutez les changements dans les sélecteurs de filtre
        $('#category-filter, #format-filter, #sort-order').change(function() {
            // Récupérez les valeurs sélectionnées dans les filtres
            var categorie = $('#category-filter').val();      //   modifiee 23 09
            var format = $('#format-filter').val();
            var sortOrder = $('#sort-order').val();
        

            // Effectuez une requête AJAX pour récupérer les images filtrées
            $.ajax({
                url:'./wp-admin/admin-ajax.php', // URL de l'endpoint AJAX de WordPress
                type: 'POST',
                data: {
                    action: 'filter_images', // Nom de l'action WordPress à appeler
                    categorie: categorie,     //   modifiee 23 09
                    format: format,
                    sortOrder: sortOrder
                },
                success: function(response) {
                    // Mettez à jour le contenu du conteneur d'images avec la réponse AJAX
                    $('#image-container').html(response);
                }
            });
        });
    });

});