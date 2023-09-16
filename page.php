<?php


get_header();

/* Start the Loop affichage contenu de la page créée via WordPress*/

if (have_posts()) {
    while (have_posts()) {
        the_post();
        // Affiche le titre de la page
        the_title('<h1>', '</h1>');
        // Affiche le contenu de la page
        the_content();
    }
}
?>

<div>
<?php
/* Récupération de la modale pour affichage au clic sur lien dans menu */
get_template_part( '/template-parts/modale' );  /* -- Ajout --> */
?>
</div>

<?php
get_footer();
?>


