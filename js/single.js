console.log("Bonjour  single.js");


document.addEventListener("DOMContentLoaded", function() {

    // Gestion de l'ouverture de la modale au clic Bouton Contact
    let modal = document.getElementById('myModal');
    let buttonContact = document.getElementById("bouton-contact");
        // au clic  sur le bouton page single.php
    buttonContact.onclick = function() {
        modal.style.display = "block";
        console.log('activation modale via contact');
    };



    // Gestion de l'affichage img navigation au suvol des fleches   dans single.php

    jQuery(document).ready(function($) {
        $('.prev-post-arrow, .next-post-arrow').hover(function() {
        let image = $(this).data('image');
        if (image) {
        $('.navigation-image img').attr('src', image);
        }
        }, function() {
        $('.navigation-image img').attr('src', );
        });
        });

});







  
   





   














    






