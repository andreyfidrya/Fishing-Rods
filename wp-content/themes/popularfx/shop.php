<?php

/*
Theme Name: PopularFX
Author: PopularFX
Author URI: https://popularfx.com/
Description: PopularFX eCommerce theme
Version: 1.0
Text Domain: PopularFX-et

Template Name: PopularFX-shop

*/

get_header();

    generate_products_for_category_full('feeder-rods');
    generate_products_for_category_full('spinning-rods');
    generate_products_for_category_full('float-rods');

get_footer();