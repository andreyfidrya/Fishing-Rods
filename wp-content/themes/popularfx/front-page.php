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
        
        // generate_products_by_category('feeder-rods');
        // generate_products_by_category('spinning-rods');
        // generate_products_by_category('float-rods');

        // generate_discount_products('feeder-rods');
        // generate_discount_products('spinning-rods');
        // generate_discount_products('float-rods');
        
        // $product_details = generate_product_details(106);
                
        // generate_product_block(106, $product_details, 'feeder-rods');
        
        // list_all_products();

        generate_owl_cards_section('feeder-rods');
        generate_owl_cards_section('spinning-rods');
        generate_owl_cards_section('float-rods');

        // generate_filters_block('feeder-rods');

        // generate_taxonomy_filters_markup('feeder-rods');
        
        // generate_filters_block('feeder-rods');

        

    ?>

<?php
get_footer();