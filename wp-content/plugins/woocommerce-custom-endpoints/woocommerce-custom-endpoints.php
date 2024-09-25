<?php
/*
Plugin Name: WooCommerce Custom Endpoints
Description: Adds custom endpoints to WooCommerce REST API.
Version: 1.0
Author: Your Name
*/

    add_action('rest_api_init', 'register_custom_woocommerce_endpoints');

    function register_custom_woocommerce_endpoints() {
    register_rest_route('wc/v3', '/custom-data', array(
    'methods' => 'GET',
    'callback' => 'get_custom_data',
    'permission_callback' => '__return_true',
    ));
    }

    function get_custom_data($data) {
        $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        );
        
        $products = get_posts($args);
        $product_data = array();
        
        foreach ($products as $product) {
        $product_data[] = array(
        'id' => $product->ID,
        'name' => $product->post_title,
        'price' => get_post_meta($product->ID, '_price', true),
        );
        }
        
        return new WP_REST_Response($product_data, 200);
    }
