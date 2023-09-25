<div id="lightbox">
    <button id="lightbox-close">X</button>
    <button id="next-button" class="lightbox-next" onclick="changeImage(1)">Suivante ----></button>
    <button id="prev-button" class="lightbox-prev" onclick="changeImage(-1)"><----Précédente</button>

    <div class="lightbox-container">
        <a id="lightbox-image-link" href="" target="_blank"> <!-- Ajoutez un lien autour de l'image -->
            <img id="lightbox-image" class="light-img" src="" alt="Preview Image">
        </a>
        <div class="lightbox-meta">
            <span id="lightbox-reference"></span>
            <span id="lightbox-category"></span>
        </div>
    </div>
    
    <!-- Liste des images dans la lightbox -->
    <div id="lightbox-images" style="display: none;">
        <?php
        // Boucle pour afficher toutes les images et infos du custom post type "photo"
        $all_photos = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => -1, // Récupère toutes les images
        ));

        while ($all_photos->have_posts()) : $all_photos->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $categories = wp_get_post_terms(get_the_ID(), 'categorie');
            $post_url = get_permalink(); // Obtenez l'URL du post
        ?>
        <div class="lightbox-item">
        <img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>" data-category="<?php echo esc_attr($categories[0]->name); ?>">
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); // Réinitialise la requête WP_Query ?>
    </div>
</div>


