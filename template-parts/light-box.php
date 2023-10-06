
<!-- structure html lightbox -->

<div id="lightbox">
    <button id="lightbox-close">X</button>
    <button id="next-button" class="lightbox-next" >Suivante &rarr;</button>
    <button id="prev-button" class="lightbox-prev" >&larr; Précédente</button>

    <div class="lightbox-container">
        <a id="lightbox-image-link" href="" target="_blank"> <!-- Ajoutez un lien autour de l'image -->
            <img id="lightbox-image" class="light-img" src="" alt="Preview Image">
        </a>
        <div class="lightbox-meta">
            <span id="lightbox-title"></span>
            <span id="lightbox-category"></span>
        </div>
    </div>
    
    <!-- Liste des images dans la lightbox -->
    <div id="lightbox-images" style="display: none;">
        <?php
        // Boucle pour générer la requête WPquery avec photos et informations complementaires pour alimenter la lihgtbox
        $all_photos = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => -1, // Récupère toutes les images
        ));

        while ($all_photos->have_posts()) : $all_photos->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();  // récupere l'image 
            $categories = wp_get_post_terms(get_the_ID(), 'categorie');  // récupère la taxonomie categorie de l'image
            $post_url = get_permalink(); // récupère  l'URL de l'img
        ?>
        <div class="lightbox-item">
            <img src="<?php echo $thumbnail_url; ?>" title="<?php the_title(); ?>" data-category="<?php echo esc_attr($categories[0]->name); ?>" post-link="<?php echo esc_attr($post_url); ?>">
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); // Réinitialise la requête WP_Query ?>
    </div>
</div>


 <!-- Passer le tableau $all_photos au format json pour récupération et utilisation  dans light-box.js -->
<script>
    var imageData = <?php echo json_encode($all_photos->posts); ?>;
</script>