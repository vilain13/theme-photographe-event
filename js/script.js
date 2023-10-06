

document.addEventListener("DOMContentLoaded", function() {
 
    // Gestion de la modale de Contact
    let modal = document.getElementById('myModal');
    let linkContact = document.getElementById("menu-item-53");
    let closeCross = document.getElementsByClassName("close-cross")[0];

            // Ouverture au clic du lien dans le header 
        linkContact.onclick = function() {
            modal.style.display = "block";
            console.log('activation modale');
        };

            // Fermeture de la modale
        closeCross.onclick = function() {
            modal.style.display = "none";
        };


    // Gestion de l'ouverture/fermeture  du menu Burger 
    let burger = document.getElementById('menu-burger');
    let fullscreenMenu = document.getElementById('menu-menu-principal');

    burger.onclick = function() {
        burger.classList.toggle('active');
        fullscreenMenu.classList.toggle('active');
    };

});























  













  












    






