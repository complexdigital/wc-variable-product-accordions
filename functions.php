<?php
/**
* Custom Functions
* @package Storefront Child
*/

function storefront_child_scripts(){
    wp_enqueue_style('storefront-fontawesome-5', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');
    wp_enqueue_script('storefront-wc-varation-accordion', get_stylesheet_directory_uri() .'/inc/variation.jquery.js');
} add_action('wp_enqueue_scripts', 'storefront_child_scripts');
