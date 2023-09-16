console.log("bonjour JS");

document.addEventListener("DOMContentLoaded", function() {
 
 



    // Gestion de la modale de Contact
    let modal = document.getElementById('myModal');
    let linkContact = document.getElementById("menu-item-53");
    let closeCross = document.getElementsByClassName("close-cross")[0];



            // au clic du lien dans le header 
        linkContact.onclick = function() {
            modal.style.display = "block";
            console.log('activation modale');
        };



            // Fermeture de la modale
        closeCross.onclick = function() {
            modal.style.display = "none";
        };


    // Gestion de l'animation du menu Burger
    let burger = document.getElementById('menu-burger');
    let fullscreenMenu = document.getElementById('menu-menu-principal');

    burger.onclick = function() {
        burger.classList.toggle('active');
        fullscreenMenu.classList.toggle('active');
        console.log("active burger et fullscreen");
    };


    // Gestion de l'apparition du menu mobile au clic Burger


});

























  

  //  Gestion du Bouton Afficher Plus D'images dans le Portofolio ( front-page.php & single.php)
  
                        // Gestion du bouton afficher plus de front-page.php
                           // console.log("script js gestion afficher plus btn");
                            //let buttonAfficherPlus = document.getElementById("afficher-plus-acceuil2"); 

                        // au clic  sur le bouton page single.php
                            //buttonAfficherPlus.addEventListener("click", function() { 
                            //postPerPage = postPerPage+2;
                            //document.cookie = "postPerPage=" + postPerPage;

                            //console.log('afficher plus 2 imgs');
                            //console.log(postPerPage);
                            //});
                           
                          
                        // Appelez la fonction pour mettre à jour la variable sur le serveur
                            //mettreAJourVariable(postPerPage);




    // Utilisez AJAX pour envoyer la valeur au serveur
//jQuery.ajax({
   // method: 'POST',
//url: ajaxurl, // Assurez-vous que ajaxurl est correctement défini dans votre environnement WordPress
//data: {
        //action: 'set_posts_per_page',
      //  postPerPage: postPerPage,
   // },
  // success: function(response) {
        // La requête a réussi, vous pouvez faire quelque chose ici si nécessaire
//}
//});













  












    






