<?php

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );


// Appel des ressources CSS et JS
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/sass/style.css', array(), filemtime(get_template_directory() . '/sass/style.css'));
} 

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts() {
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', false);
} 




   // Charger un script spécifique  du single.php
function capitaine_assets() {
 
  if( is_single() ) {
      wp_enqueue_script('capitaine_comments', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), '1.0', false );
  }
}
add_action( 'wp_enqueue_scripts', 'capitaine_assets' );


function enqueue_custom_scripts() {
    wp_enqueue_script('front-page-script', get_template_directory_uri() . '/js/front-page.js', array('jquery'), '1.0', false);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');





// Fonction AJAX pour récupérer les images en fonction des filtres et tri sur la page front-page.php
function fetch_filtered_images() {
    // Récupérez les valeurs des filtres depuis la requête AJAX
    $category = $_POST['category'];
    $format = $_POST['format'];
    $sortOrder = $_POST['sort_order'];

    // Vérifiez si la catégorie est "all_categories" et ajustez-la si nécessaire
    if ($category === 'all_categories') {
        $category = ''; // Laissez la catégorie vide pour afficher toutes les catégories
    }

    // Vérifiez si le format est "all_formats" et ajustez-le si nécessaire
    if ($format === 'all_formats') {
        $format = ''; // Laissez le format vide pour afficher tous les formats
    }

    // Créer une requête WP_Query pour obtenir les images filtrées
    $args = array(
        'post_type' => 'photo', // Type de post où sont stockées vos images créé via CPTUI
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => $sortOrder,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => ($category) ? $category : get_all_category_slugs(), 
                'operator' => 'IN',
            ),
            array(
                'taxonomy' => 'formats',
                'field' => 'slug',
                'terms' => ($format) ? $format : get_all_format_slugs(),
                'operator' => 'IN',
            ),
        ),
    );

    $query = new WP_Query($args);

    // Récupérer les résultats de la requête
    $images = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Récupérez l'URL de la page du post de l'image
            $post_url = get_permalink();
            
            // Récupérer l'URL de l'image
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];

            // Récupérer l'objet de category
            $post_category = get_the_terms(get_the_ID(), 'category');

            // Récupérer l'objet de formats
            $post_formats = get_the_terms(get_the_ID(), 'formats');

            $images[] = array(
                'post_url' => $post_url,
                'image_url' => $image_url,
                'category' => $post_category,
                'formats' => $post_formats,
            );
        }
    }

    wp_reset_postdata();

    // Retourner les résultats en tant que réponse JSON
    echo json_encode($images);

    die(); // Arrêter l'exécution après avoir renvoyé la réponse JSON
}

// Hook pour lancer la fonction AJAX
add_action('wp_ajax_fetch_filtered_images', 'fetch_filtered_images');
add_action('wp_ajax_nopriv_fetch_filtered_images', 'fetch_filtered_images');

// Fonction pour obtenir tous les slugs de catégories
function get_all_category_slugs() {
    $categories = get_terms(array('taxonomy' => 'category', 'hide_empty' => false));
    $slugs = array();
    foreach ($categories as $category) {
        $slugs[] = $category->slug;
    }
    return $slugs;
}

// Fonction pour obtenir tous les slugs de formats
function get_all_format_slugs() {
    $formats = get_terms(array('taxonomy' => 'formats', 'hide_empty' => false));
    $slugs = array();
    foreach ($formats as $format) {
        $slugs[] = $format->slug;
    }
    return $slugs;
}








  


// Enregistrement de l'emplacement du menu
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );


/**
* Creation du parametrage Logo su WP
*/
function your_theme_new_customizer_settings($wp_customize) {
    // add a setting for the site logo
    $wp_customize->add_setting('your_theme_logo');
    // Add a control to upload the logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'your_theme_logo', array(
        'label'    => 'Upload Logo',
        'section'  => 'title_tagline',
        'settings' => 'your_theme_logo',
    )));
}
add_action('customize_register', 'your_theme_new_customizer_settings');


// Enregistrement de l'emplacement du menu pour le footer
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );



// Code supplementaire  pour la navigation img de la page single.php  Xxxxxxxxxxx

// Fonction pour obtenir l'ID du post précédent ou suivant trié par année
function get_new_post_id() {
    $post_id = $_POST['post_id'];
    $direction = $_POST['direction'];

    // Utilisez WP_Query pour obtenir l'ID du post précédent ou suivant trié par année.
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => ($direction === 'next') ? 'ASC' : 'DESC', // Tri par année ici.
        'tax_query' => array(
            array(
                'taxonomy' => 'annee',
                'field' => 'id',
                'terms' => get_the_terms($post_id, 'annee')[0]->term_id,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        $new_post_id = get_the_ID();
    }

    wp_reset_postdata();
    
    echo $new_post_id;
    wp_die();
}

add_action('wp_ajax_get_new_post_id', 'get_new_post_id');
add_action('wp_ajax_nopriv_get_new_post_id', 'get_new_post_id');


