<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="p-gridline"></div>
    <div class="p-viewport"></div>

    <header class="l-header">
        <h1 class="l-header__title">VIEWPOINT</h1>
        <?php get_template_part(slug: 'template-parts/global-nav'); ?>
    </header>