<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'lp' ); ?>>
<?php wp_body_open(); ?>

<header class="lp-header">
    <div class="lp-header__inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lp-header__logo">
            <?php bloginfo( 'name' ); ?>
        </a>
    </div>
</header>

<main class="lp-main">
