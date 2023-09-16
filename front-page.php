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
                $terms = get_terms('category');
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
    



    <?php






            // Selection du type de posts

            // add_action('wp_ajax_set_posts_per_page', 'set_posts_per_page');
            //add_action('wp_ajax_nopriv_set_posts_per_page', 'set_posts_per_page');

            //function set_posts_per_page() {
                // Récupérez la valeur de la variable "nombre" envoyée via AJAX
                //$postPerPage = isset($_POST['postPerPage']) ? intval($_POST['postPerPage']) : 10; // 10 est la valeur par défaut

                // Votre requête WordPress avec la valeur de "nombre"
                //$args = array(
                // 'post_type' => 'photo', // Utilisez le slug de votre CPT
                // 'posts_per_page' => $postPerPage,
            // );

                // Effectuez votre requête ici

                // Vous pouvez également renvoyer une réponse JSON si nécessaire
                //echo json_encode($args);

                // Assurez-vous de quitter le script après avoir renvoyé la réponse
            // wp_die();
            //}

?>




      
        <div  class="portofolio">
   
            <div id="image-container" class="row gallery">
                 <!-- Les images filtrées seront affichées ici -->
            </div>
        </div>

        
        <div id="afficher-plus-acceuil2" class="bouton-afficherplus">
            <input  class="bouton-post" type="button" value="Afficher plus" />
        </div>
   
        <div>
        <?php get_template_part( '/template-parts/modale' ); ?> <!-- Ajout -->  
        </div>
    </main>


   


</body>

<?php get_footer(); ?>

</html>


