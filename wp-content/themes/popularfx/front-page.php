<?php 
/**
 * The front page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PopularFX
 */

get_header();
?>

    <?php
        
        // generate_products_by_category('feeder-roads');
        // generate_products_by_category('spinning-roads');
        // generate_products_by_category('float-roads');

        // generate_discount_products('feeder-roads');
        // generate_discount_products('spinning-roads');
        // generate_discount_products('float-roads');
        
        $product_details = generate_product_details(106);
        
        generate_product_block(106, $product_details, 'feeder-roads');        

    ?>

<?php
get_footer();