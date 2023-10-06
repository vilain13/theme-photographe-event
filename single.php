<?php
get_header(); // Inclut l'en-tête du thème
?>


<main id="main" class="site-main" role="main">

 <?php
        // La boucle WordPress pour récupérer les éléments du Post à afficher
        if (have_posts()) :
            while (have_posts()) :
                the_post();?>
                        
                <article class="entry-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        
                        <div class="entry-meta">
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                            <!-- Afficher les informations du Post Photo,-->
                            <?php
                            // Récupérer le Référence Photo du poste actuel
                            $champ_reference = get_post_meta(get_the_ID(), 'reference_photo', true);
                            $libelle_champ = get_post_meta(get_the_ID(), $nom_du_champ, true);

                            // Vérifiez si la valeur du champ personnalisé existe avant de l'afficher.
                            if (!empty($champ_reference)) {
                                echo '<h3> REFERENCE : ' . $champ_reference . '</h3>';
                                
                            } else {
                                echo '<h3> REFERENCE : aucune valeur renseignée </h3>';
                            }

                            // Récupérer la Catégorie du post actuel
                            $categorie = get_the_terms(get_the_ID(), 'categorie');

                            // Assurez-vous qu'il y a des termes associés à cette taxonomie
                            if (!empty($categorie)) {
                                echo '<h3> CATEGORIE : ' . $categorie[0]->name . '</h3>';
                                
                            } else {
                                echo '<h3> CATEGORIE : aucune valeur renseignée </h3>';
                            }

                            // Récupérer les termes de la taxonomie "Formats" pour le post actuel
                            $formatsTerm = get_the_terms(get_the_ID(), 'formats');   

                            // Assurez-vous qu'il y a des termes associés à cette taxonomie
                            if (!empty($formatsTerm)) {    
                                echo '<h3> FORMAT : ' . $formatsTerm[0]->name . '</h3>';   
                                
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


                            // Récupérer les termes de  "Annee" pour le post actuel
                            $annee = get_the_terms(get_the_ID(), 'annee');   

                            // Assurez-vous qu'il y a des termes associés à Année
                            if (!empty($annee)) {                           
                                echo '<h3> ANNEE : ' . $annee[0]->name . '</h3>'; 
                                
                            } else {
                                echo '<h3> ANNEE : aucune valeur renseignée </h3>';
                            }?>
                        
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
        endif; ?>

        <!-- Ajout section " Vous aimerez aussi avec navigation -->
                <div class="section-pagination-photos"> 
                    <div class="activation-modale">
                        <p> Cette photo vous interesse ? </p>
                        <input id="bouton-contact" class="post-button" type="button" value="Contact" />
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
//  Afficher le Portfolio en fonction de la taxonomie  CPTUI Categorie du Post actif.

// Récupérer la catégorie (terme) CPTUI  associée au post actif
$categorie_filtre = wp_get_post_terms(get_the_ID(), 'categorie');   ////   modifiee 23 09


// Vérifier si des termes (catégories) ont été trouvés
if ($categorie_filtre && !is_wp_error($categorie_filtre)) {     ////   modifiee 23 09
    $categorie_filtre_slug = $categorie_filtre[0]->slug; // Prendre le slug du premier terme trouvé (vous pouvez adapter si nécessaire)  ////   modifiee 23 09
    
    // Récupérer les images mises en avant du Custom Post Type "Portfolio" avec la catégorie correspondante
    $args = array(
        'post_type' => 'photo', // Slug  du CPTUI créé 
        'posts_per_page' => 2,
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',  
                'field' => 'slug',
                'terms' => $categorie_filtre_slug, // Utilisez le slug de la catégorie du post actif    
            ),
        ),
        'post__not_in' => array( get_the_ID() ), // Pour ne pas reprendre  la photo affichée du post actif
    );
  


  // Afficher  les images mises en avant des posts avec la méme categorie que le Post Actif
        ?>
        <div class="afficher-plus">
            <h3> Vous aimerez aussi ...</h3>

            <div class="portofolio">
                <div class="row gallery">
        <?php
    $query = new WP_Query($args); ?>

    <?php if ($query->have_posts()) : 

                // Récupérer les éléments à afficher dans le template part
           
                         while ($query->have_posts()) : $query->the_post(); 
                        $thumbnail_url = get_the_post_thumbnail_url();
                        $categories = wp_get_post_terms(get_the_ID(), 'categorie');  
                        $formats = wp_get_post_terms(get_the_ID(), 'formats');
                        ?>  
                            <?php get_template_part( '/template-parts/photo-block' );?>
                    <?php endwhile; ?>
                </div>
            </div>
         
     <?php   
    else :
        // Aucun résultat trouvé
        echo 'Aucune autre image trouvée dans cette catégorie.';
    endif;
}?>


            <a id="all-images" class="more-button" href="http://localhost:8888/photographe-event/">
                     <input class="post-button" type="button" value="Toutes les photos "/>
            </a>
            
 </main>

<?php
get_footer(); // Inclut le pied de page du thème