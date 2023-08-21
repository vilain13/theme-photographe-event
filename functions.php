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
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js', array(), '1.0', true);
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


