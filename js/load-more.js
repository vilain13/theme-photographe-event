document.addEventListener("DOMContentLoaded", function() {

  console.log("Bonjour Loadmore  JS")

//  Déclenchement de l'affichage d'images supplémentaires 

  jQuery(document).ready(function ($) {
      let page = 1;
      $("#load-more").on("click", function () {
        page++; // Ajout de 1 à la page
        $.ajax({
          type: "POST",
          url: './wp-admin/admin-ajax.php',
          dataType: "html",
          data: {
            action: "load_more_photos",
            page : page,
          },
          success: function (response) {
            $("#image-container").append(response);
          },
        });
      });
  });























// ////  Essai avec ré initialisation de la page à 1  lorsque les filtres changent

// jQuery(document).ready(function ($) {
//   let page = 1;
//   $("#load-more").on("click", function () {
//       page++;
//       loadMorePhotos(page);
//   });

//   //Fonction pour réinitialiser la page à 1 lorsque les filtres sont modifiés.  PAs fonctionnel met le bazar dans les filtres.
//   $("#category-filter, #format-filter").on("change", function () {
//       page = 1;
//       loadMorePhotos(page);
//   });

//   function loadMorePhotos(page) {
//       $.ajax({
//           type: "POST",
//           url: "./wp-admin/admin-ajax.php",
//           dataType: "html",
//           data: {
//               action: "load_more_photos",
//               page: page,
//           },
//           success: function (response) {
//               $("#image-container").append(response);
//           },
//       });
//   }
// });










});



       

       