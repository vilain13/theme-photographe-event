

<?php
get_header(); // Inclut l'en-tête du thème
?>


<main id="main" class="site-main" role="main">

  
        <?php
        // La boucle WordPress pour récupérer les éléments du Psot à afficher
        if (have_posts()) :
            while (have_posts()) :
                the_post();?>
            
                        <div>
                            <?php
                        /* Récupération de la modale pour affichage au clic sur lien dans menu */
                        get_template_part( '/template-parts/modale' );  /* -- Ajout --> */
                        ?>
                        </div>
                        
                <article class="entry-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        
                        <div class="entry-meta">
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                            <!-- Affichez les informations du Post Photo,-->
                            <?php
                            // Récupérer le Référence Photo du poste actuel
                            $champ_format = get_post_meta(get_the_ID(), 'reference_photo', true);
                            $libelle_champ = get_post_meta(get_the_ID(), $nom_du_champ, true);

                            // Vérifiez si la valeur du champ personnalisé existe avant de l'afficher.
                            if (!empty($champ_format)) {
                                echo '<h3> REFERENCE : ' . $champ_format . '</h3>';
                                
                            } else {
                                echo '<h3> REFERENCE : aucune valeur renseignée </h3>';
                            }

                            // Récupérez la Catégorie du post actuel
                            $categories = get_the_category();

                            if (!empty($categories)) {
                                echo '<h3> CATEGORIE : ' . $categories[0]->name . '</h3>';
                            } else {
                                echo '<h3> CATEGORIE : aucune valeur renseignée </h3>';
                            }

                            // Récupérer les termes de la taxonomie "Formats" pour le post actuel
                            $terms = get_the_terms(get_the_ID(), 'formats');

                            // Assurez-vous qu'il y a des termes associés à cette taxonomie
                            if (!empty($terms)) {
                                echo '<h3> FORMAT : ' . $terms[0]->name . '</h3>';
                                
                            } else {
                                echo '<h3> FORMAT : aucune valeur renseignée </h3>';
                            }

                            // Récupérer le Type de  Photo du post actuel
                            $champ_personnalise = get_post_meta(get_the_ID(), 'type_photo', true);
                            $libelle_champ = get_post_meta(get_the_ID(), $nom_du_champ, true);

                            // Vérifiez si la valeur du champ personnalisé existe avant de l'afficher.
                            if (!empty($champ_personnalise)) {
                                echo '<h3> TYPE : ' . $champ_personnalise . '</h3>';
                                
                            } else {
                                echo '<h3> TYPE : aucune valeur renseignée </h3>';
                            }


                            // Récupérer les termes de la taxonomie "Annee" pour le post actuel
                            $terms = get_the_terms(get_the_ID(), 'annee');

                            // Assurez-vous qu'il y a des termes associés à cette taxonomie
                            if (!empty($terms)) {
                                echo '<h3> ANNEE : ' . $terms[0]->name . '</h3>';
                                
                            } else {
                                echo '<h3> ANNEE : aucune valeur renseignée </h3>';
                            }


                            ?>                           
                        </div>
                    </div>

                    <div class="entry-image">
                        <?php
                        // Ajout de l'image mise en avant
                        if (has_post_thumbnail()) : ?>
                            <div id="featured-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif;
                        ?>
                    </div>
                </article>
                <?php
            endwhile;
        endif;
        ?>

        
                <div class="section-pagination-photos"> 
                    <div class="activation-modale">
                        <p> Cette photo vous interesse ? </p>
                        <input id="bouton-contact" class="bouton-post" type="button" value="Contact" />
                    </div>

                    <div class="post-navigation">
                        <div id="small-image" class="navigation-image">
                            <div class="featured-image">
                                <?php
                                // Récupérer l'URL de l'image du post actif
                                $current_post_image_url = get_the_post_thumbnail_url($current_post_id);
                                ?>
                                <img src="<?php echo esc_url($current_post_image_url); ?>" alt="Preview Image">
                            </div>
                                <?php
                                // variables du post en cours post précedant et post suivant
                                $current_post_id = get_the_ID();
                                $prev_post = get_previous_post();
                                 $next_post = get_next_post();

                                //Récupération des url post précédant et post suivant
                                if ($prev_post) {
                                $prev_post_image_url = get_the_post_thumbnail_url($prev_post->ID);
                                }
                                if ($next_post) {
                                $next_post_image_url = get_the_post_thumbnail_url($next_post->ID);
                                }
                                ?>

                            <div class="arrows-nav">
                                <?php if ($prev_post && $prev_post_image_url) : ?>
                                    <p class="prev-post-arrow" data-image="<?php echo esc_url($prev_post_image_url); ?>" data-post-id="<?php echo $prev_post->ID; ?>">←</p>
                                <?php endif; ?>
                                <?php if ($next_post && $next_post_image_url) : ?>
                                    <p class="next-post-arrow" data-image="<?php echo esc_url($next_post_image_url); ?>" data-post-id="<?php echo $next_post->ID; ?>">→</p>
                                <?php endif; ?>
                            </div>
                         </div>
                    </div>
                </div>


<script>
//  Gestion au clic de la navigation du Post Actif
    // Fonction pour gérer le clic sur la flèche précédente
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('prev-post-arrow')) {
            const prevPostID = event.target.getAttribute('data-post-id');
            // Vous pouvez maintenant utiliser prevPostID pour changer le post actif sans AJAX
            // Par exemple, rediriger l'utilisateur vers le lien de l'article précédent
            window.location.href = '<?php echo get_permalink($prev_post->ID); ?>';
        }
    });

    // Fonction pour gérer le clic sur la flèche suivante
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('next-post-arrow')) {
            const nextPostID = event.target.getAttribute('data-post-id');
            // Vous pouvez maintenant utiliser nextPostID pour changer le post actif sans AJAX
            // Par exemple, rediriger l'utilisateur vers le lien de l'article suivant
            window.location.href = '<?php echo get_permalink($next_post->ID); ?>';
        }
    });
</script>

        <?php
/////////////////////////////////////////







////////////////////////////////////////////////////////////////////////
//  Afficher le Portofolio en fonction de la taxonomie Category du Post actif.

// Récupérer la catégorie (terme) associée au post actif
$terms = wp_get_post_terms(get_the_ID(), 'category'); 


// Vérifier si des termes (catégories) ont été trouvés
if ($terms && !is_wp_error($terms)) {
    $term_slug = $terms[0]->slug; // Prendre le slug du premier terme trouvé (vous pouvez adapter si nécessaire)
    
    // Récupérer les images mises en avant du Custom Post Type "Portfolio" avec la catégorie correspondante
    $args = array(
        'post_type' => 'photo', // Slug  du CPTUI créé 
        'posts_per_page' => 4,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', 
                'field' => 'slug',
                'terms' => $term_slug, // Utilisez le slug de la catégorie du post actif
            ),
        ),
        'post__not_in' => array( get_the_ID() ), // Pour ne pas reprendre  la photo affichée du post actif
    );


  // Afficher  les images mises en avant des posts avec la méme categorie que le Post Actif

    $query = new WP_Query($args); ?>

        <div class="afficher-plus">
            <h3> Vous aimerez aussi ...</h3>
    <?php if ($query->have_posts()) : 
      
                // Récupérer l'image mise en avant
        if (has_post_thumbnail()) : ?>
            <div class="portofolio">
                <div class="row gallery">
                    <?php while ($query->have_posts()) : $query->the_post(); 
                        $thumbnail_url = get_the_post_thumbnail_url();
                        
                        $categories = wp_get_post_terms(get_the_ID(), 'category');
                        $formats = wp_get_post_terms(get_the_ID(), 'formats');
                        ?>  
                           
                           
                          
                                <article class="photo filtered-image">
                                    <div class="rollover-image rowling-image">
                                        <span class="rollover-category category-label">
                                            <?php
                                            if (!empty($categories)) {
                                                echo esc_html($categories[0]->name);
                                            }
                                            ?>
                                        </span><br>
                                        <span class="rollover-format format-label">
                                            <?php
                                            if (!empty($formats)) {
                                                echo esc_html($formats[0]->name);
                                            }
                                            ?>
                                        </span>
                                        <span class="rollover-fullscreen fa-solid fa-expand fa-2xl"></span>
                                        <a href="<?php the_permalink(); ?>" class="rollover-eye fa-solid fa-eye fa-2xl"></a>
                                    </div>
                                        <img class="img-fluid" src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
     
                                                
                                           
                        
                                </article>
                          
                    <?php endwhile; ?>
                </div>
            </div>
         
        <?php endif;   
    else :
        // Aucun résultat trouvé
        echo 'Aucune autre image trouvée dans cette catégorie.';
    endif;
}?>











            <div class="bouton-afficherplus">
                     <input class="bouton-post" type="button" value="Toutes les photos "/>
            </div>



            


 </main>




<?php
get_footer(); // Inclut le pied de page du thème
