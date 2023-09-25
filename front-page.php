<?php get_header();?>
<body>
    <main>

        <div class = "banner">
        
        <img class="" src="<?php echo get_template_directory_uri() . '/assets/Header.png'; ?> " alt="image header  Photographe Event"> 
        </div>
        
        
        
        <div id="filter-section" class="filters">
        
            <select onfocus="this.size=1;"  name="categorie" id="category-filter">
                <option value="" selected>TOUTES CATEGORIES</option>
                <?php
                $terms = get_terms('categorie');    // modifiee 23 09
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                }
                ?>
            </select>

            <select onfocus="this.size=1;"  name="format" id="format-filter">
                <option value="" selected>TOUS FORMATS</option>
                <?php
                $terms = get_terms('formats');
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                }
                ?>
            </select>

            <select onfocus="this.size=1;"  name="tri" id="sort-order">
                <option value="">TRIER PAR</option>
                <option value="asc">Plus Ancien</option>
                <option value="desc">Plus Récent</option>
            </select>
            </div>
      
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
        
        <div id="load-more" class="bouton-afficherplus">
            <input class="bouton-post"  type="button" value="Afficher plus" />
        </div>
   
       
    </main>

</body>

 <?php get_footer(); ?>

</html>


