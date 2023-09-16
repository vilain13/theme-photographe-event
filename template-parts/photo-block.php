<?


// Afficher  les images mises en avant des posts avec la méme categorie que le Post Actif

    $query = new WP_Query($args); ?>

        <div class="afficher-plus">
            <h3> Vous aimerez aussi ...</h3>
    <?php if ($query->have_posts()) : 
      
                // Récupérer l'image mise en avant
        if (has_post_thumbnail()) : ?>
            <div class="container">
                <div class="row">
                    <?php while ($query->have_posts()) : $query->the_post(); 
                        $thumbnail_url = get_the_post_thumbnail_url();
                        
                        $categories = wp_get_post_terms(get_the_ID(), 'category');
                        $formats = wp_get_post_terms(get_the_ID(), 'formats');
                        ?>  
                           
                           
                          
                                <article class="filtered-image">
                                    <div class="rowling-image">
                                        <i class="fa-solid fa-expand fa-2xl"></i>
                                        <i class="fa-solid fa-eye fa-2xl"></i>
                                    </div>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="image-container-div">
                                            <img class="img-fluid" src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
                                            
                                            <div class="info-image">
                                                
                                                <span class="category-label">
                                                    <?php
                                                    if (!empty($categories)) {
                                                        echo esc_html($categories[0]->name);
                                                    }
                                                    ?>
                                                </span><br>
                                                <span class="format-label">
                                                    <?php
                                                    if (!empty($formats)) {
                                                        echo esc_html($formats[0]->name);
                                                    }
                                                    ?>
                                                </span>
                                            </div> 
                                        </div>
                                    </a>
                                </article>
                          
                    <?php endwhile; ?>
                </div>
            </div>
         
        <?php endif;   
    else :
        // Aucun résultat trouvé
        echo 'Aucune autre image trouvée dans cette catégorie.';
    endif;
?>