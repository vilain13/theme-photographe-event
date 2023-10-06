<footer>

<?php
// Affichage du menu du footer

wp_nav_menu([
    'theme_location' => 'footer-menu', // Utilisez le même nom que vous avez enregistré pour le menu du footer
]); 
?>

<!-- Ajout de la lightbox et de la modale "contact" -->
<?php get_template_part( '/template-parts/light-box' );?>
<?php get_template_part( '/template-parts/modale' );?>


</footer>