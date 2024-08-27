<?php 

/*
Theme Name: PopularFX
Author: PopularFX
Author URI: https://popularfx.com/
Description: PopularFX eCommerce theme
Version: 1.0
Text Domain: PopularFX-et

Template Name: PopularFX-discounts

*/

get_header();
?>
    <section class="discounts-section category-section">
        <div class="discounts-container category-section-container">
        <h2 class="category-section-title">СКИДКИ</h2>
        <p class="category-section-text">В нашем интернет магазине можно получить скидки на следующие товары:</p>
    <?php
    generate_discount_products('feeder-roads');
    generate_discount_products('spinning-roads');
    generate_discount_products('float-roads');
    ?>            
        </div>
    </section>
<?php
get_footer();