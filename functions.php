<?php

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );


// Déclaration  des ressources CSS et JS
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/sass/style.css', array(), filemtime(get_template_directory() . '/sass/style.css'));
} 

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts() {
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', false);
    wp_enqueue_script('front-page-script', get_template_directory_uri() . '/js/front-page.js', array('jquery'), '1.0', false);
    wp_enqueue_script('light-box-script', get_template_directory_uri() . '/js/light-box.js', array('jquery'), '1.0', false);
    wp_enqueue_script('load-more-script', get_template_directory_uri() . '/js/load-more.js', array('jquery'), '1.0', false);
    wp_enqueue_script('flitre-tri-script', get_template_directory_uri() . '/js/filtres-tri.js', array('jquery'), '1.0', false);
} 


   // Charger un script spécifique  du single.php
function theme_single_scripts() {
 
  if( is_single() ) {
      wp_enqueue_script('single-script', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), '1.0', false );
  }
}
add_action( 'wp_enqueue_scripts', 'theme_single_scripts' );




// Enregistrement de l'emplacement du menu
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

 
//Creation du parametrage Logo su WP

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







///////////////////////// Code supplementaire  pour la navigation img de la page SINGLE.PHP  Xxxxxxxxxxx

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




//////////////////////////////  Fonction pour pour la gestion des filtres   sur Taxonomie "Category" et "Formats"  avec Filtre sur "Date" date de publication post


// Fonction pour filtrer les images en fonction des critères
function filter_images() {
  $category = sanitize_text_field($_POST['categorie']);    //   modifiee 23 09
  $format = sanitize_text_field($_POST['format']);
  $sortOrder = sanitize_text_field($_POST['sortOrder']);

  $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12,
      'orderby' => 'date',
      'order' => $sortOrder,
      'paged' => 1,
  );


  
  if (!empty($category) || !empty($format)) {
    $args['tax_query']['relation'] = 'AND'; // Utilisez 'AND' pour combiner les filtres (peut également utiliser 'OR' si nécessaire)
}




  // Ajoutez des conditions pour les filtres
  // if (!empty($category)) {
  //     $args['categorie_name'] = $category;
  // }
//   if (!empty($category)) {
//     $args['tax_query'] = array(
//         array(
//             'taxonomy' => 'categorie',
//             'field' => 'slug',
//             'terms' => $category,
//         ),
//     );
// }

if (!empty($category)) {
  $args['tax_query'][] = array(
      'taxonomy' => 'categorie',
      'field' => 'slug',
      'terms' => $category,
  );
}



  // if (!empty($format)) {
  //     $args['tax_query'] = array(
  //         array(
  //             'taxonomy' => 'formats',
  //             'field' => 'slug',
  //             'terms' => $format,
  //         ),
  //     );
  // }

  if (!empty($format)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'formats',
        'field' => 'slug',
        'terms' => $format,
    );
}


  $query = new WP_Query($args);

  if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
          // Utilisez get_template_part pour charger le template-part photo-block
          get_template_part('template-parts/photo-block');
      endwhile;
  else :
      echo 'Aucune image trouvée.';
  endif;

  wp_reset_query();

  die(); // Important pour terminer la requête AJAX
}

// Ajoutez l'action WordPress pour la fonction AJAX
add_action('wp_ajax_filter_images', 'filter_images');
add_action('wp_ajax_nopriv_filter_images', 'filter_images');




//////////////////////////////  Fonction pour le chargement des images supplementaires  sur front-page

// Fonction pour le chargement des images supplementaires sur front-page
function load_more_photos()
{
  $ajaxposts = new WP_Query([
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'paged' => $_POST['page'],
  ]);

  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) {
      $ajaxposts->the_post();

      $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $_POST['page'],
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('/template-parts/photo-block');
        }
      } else {
        $response = 'Pas de photo supplémentaire à afficher !!!';
      }
    }
  } else {
    $response = 'Pas de photo supplémentaire à afficher !!!';
  }

  echo $response;
  exit;
}


add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');





















