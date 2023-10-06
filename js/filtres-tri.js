
document.addEventListener("DOMContentLoaded", function() {

    jQuery(document).ready(function($) {
        // Écouter les changements dans les sélecteurs de filtre
        $('#category-filter, #format-filter, #sort-order').change(function() {
            // Récupérer les valeurs sélectionnées dans les filtres
            var categorie = $('#category-filter').val();     
            var format = $('#format-filter').val();
            var sortOrder = $('#sort-order').val();
            if(categorie === "" && format === ""){
                localStorage.setItem('page', JSON.stringify(1));
            } else {
                localStorage.setItem('page', JSON.stringify(2)); 
            }
            
   

            // Effectuer une requête AJAX pour récupérer les images filtrées
            $.ajax({
                url:'./wp-admin/admin-ajax.php', // URL de l'endpoint AJAX de WordPress
                type: 'POST',
                data: {
                    action: 'filter_images', // Nom de l'action WordPress à appeler
                    categorie: categorie,     
                    format: format,
                    sortOrder: sortOrder
                },
                success: function(response) {
                    // Mettre à jour le contenu du conteneur d'images avec la réponse AJAX
                    $('#image-container').html(response);
                }
            });
        });
    });

});