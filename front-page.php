<?php get_header();?>
<body>
    <main>
    
        <div class = "banner">
        <?php
           // Affichage d'une image différente de cptui 'photo' à chaque actualisation de la page
            query_posts(array('post_type' => 'photo', 'orderby' => 'rand', 'showposts' => 1 ));
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                <div class="banner-image" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>');">
                    <h1 class="banner-title">photographe event</h1>
                </div>
                <?php endwhile;
            endif ?>    
        </div>
        
        <!-- Selecteurs de filtres sur taxonomies categorie et formats et tri sur date post -->
        <div id="filter-section" class="filters">
        
            <select  name="categorie" id="category-filter">
                <option value="" selected>TOUTES CATEGORIES</option>
                <?php
                $terms = get_terms('categorie');    // modifiee 23 09
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                }
                ?>
            </select>

            <select  name="format" id="format-filter">
                <option value="" selected>TOUS FORMATS</option>
                <?php
                $terms = get_terms('formats');
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                }
                ?>
            </select>

            <select  name="tri" id="sort-order">
                <option value="">TRIER PAR</option>
                <option value="asc">Plus Ancien</option>
                <option value="desc">Plus Récent</option>
            </select>
         </div>

       <!-- Portfolio -->
        <div  class="portofolio">
            <div id="image-container" class="row gallery">
                <?php

                // Récupération des images   PortFolio à l'ouverture du site
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => 1,
                );
                //Création d'une  instance de requête WP_Query basée sur les critères placés dans la variables $args
                $query = new WP_Query($args);?>

                <?php if ($query->have_posts()): ?>

                        <?php while ($query->have_posts()): $query->the_post(); ?>
                        
                            <?php get_template_part( '/template-parts/photo-block' );?>
                            
                        <?php endwhile; ?>

                <?php endif;
                wp_reset_query();
                ?>
            </div>
        </div>
        
        <div id="load-more" class="more-button">
            <input class="post-button"  type="button" value="Afficher plus" />
        </div>
   
        
    </main>

</body>

 <?php get_footer(); ?>

</html>


