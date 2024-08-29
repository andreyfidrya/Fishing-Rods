<?php

/*
Theme Name: PopularFX
Author: PopularFX
Author URI: https://popularfx.com/
Description: PopularFX eCommerce theme
Version: 1.0
Text Domain: PopularFX-et

Template Name: PopularFX-feeder-rods

*/

get_header();
?>
    <?php
    generate_products_for_category_full('feeder-rods');
    ?>
<?php
get_footer();