
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/851e05441e.js" crossorigin="anonymous"></script>
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<header>
<?php

    // check to see if the logo exists and add it to the page
    if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
        <img src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
    <?php // add a fallback if the logo doesn't exist
    else : ?>
        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
    <?php endif;
    /**
     * Affiche le menu "Menu principal" enregistré au préalable.
     */
    wp_nav_menu([
        'theme_location' => 'main-menu',
    ]);
    ?>

    <div id="menu-burger">
        <span></span>
    </div>

</header>




