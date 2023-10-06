document.addEventListener("DOMContentLoaded", function() {


//  Déclenchement de l'affichage d'images supplémentaires au clic sur bouton loadmore sur front-page

  jQuery(document).ready(function ($) {
      let page = 1;
      localStorage.setItem('page', JSON.stringify(page));
      $("#load-more").on("click", function () {
        page = JSON.parse(localStorage.getItem('page'));
        page++; // Ajout de 1 à la page
        localStorage.setItem('page', JSON.stringify(page));
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



       

       