<div id="lightbox">
    <button id="lightbox-close">X</button>
    <button id="next-button" class="lightbox-next" onclick="changeImage(-1)">Suivante ----></button>
    <button id="prev-button" class="lightbox-prev" onclick="changeImage(+1)"><----Précédante</button>

 
    <div class="lightbox-container">
       <a id="lightbox-image-link" href="" target="_blank">
            <img id="lightbox-image" class="light-img" src="" alt="Preview Image">
        </a>
        <div class="lightbox-meta">
            <span id="lightbox-reference"> <?php    echo   $champ_reference ;?></span>
            <span id="lightbox-category"> <?php       echo $categories[0]->name ;?></span>
           
    
        </div>
<div>


<?php
// Boucle pour récupérer toutes les images mises en avant du CPTUI Photo avec les éléments pour la lightBox
$all_photos = new WP_Query(array(
    'post_type' => 'photo',
    'posts_per_page' => -1, // Récupère toutes les images du cptui Photo
));

while ($all_photos->have_posts()) : $all_photos->the_post();
    $thumbnail_url = get_the_post_thumbnail_url();
    $categories = wp_get_post_terms(get_the_ID(), 'categorie');
    $reference = get_field('reference'); 
    $post_url = get_permalink();
?>


