<?php
/*
Plugin Name: WooCommerce Custom Endpoints
Description: Adds custom endpoints to WooCommerce REST API.
Version: 1.0
Author: Your Name
*/

class Custom_WooCommerce_API
{
  private $api_key = '123456789';
  private $namespace = 'custom-wc-api/v1';

  public function __construct()
  {
    add_action('rest_api_init', array($this, 'register_routes'));
  }

  public function register_routes()
  {
    register_rest_route($this->namespace, '/products', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_products'),
      //'permission_callback' => array($this, 'check_api_key'),
    ));

    register_rest_route($this->namespace, '/products/attribute/(?P<attribute>[\w-]+)/(?P<term>[\w-]+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_products_by_attribute'),
      //'permission_callback' => array($this, 'check_api_key'),
    ));

    register_rest_route($this->namespace, '/products/category/(?P<category_id>\d+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_products_by_category'),
      //'permission_callback' => array($this, 'check_api_key'),
    ));

    register_rest_route($this->namespace, '/products/tag/(?P<tag_id>\d+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_products_by_tag'),
      //'permission_callback' => array($this, 'check_api_key'),
    ));
  }

  public function get_products($request)
  {
    $products = wc_get_products(array('status' => 'publish'));
    $formatted_products = array();

    foreach ($products as $product) {
      if ($this->should_show_product($product)) {
        $formatted_products[] = $this->format_product_data($product);
      }
    }
    return new WP_REST_Response($formatted_products, 200);
  } 

  function format_product_data($product)
    {
        $formatted_product = array(
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'image_src' => wp_get_attachment_url($product->get_image_id()),
            'description' => $product->get_description(),
            'on_sale' => $product->is_on_sale(),
            'sale_price' => $product->get_sale_price(),
            'regular_price' => $product->get_regular_price(),
            'categories' => array(),
            'tags' => array(),
            'attributes' => array(),
        );
      
      // Add categories
      $categories = $product->get_category_ids();
      foreach ($categories as $category_id) {
          $category = get_term($category_id, 'product_cat');
          $formatted_product['categories'][] = array(
              'id' => $category->term_id,
              'name' => $category->name,
              'slug' => $category->slug,
          );
      }

      // Add tags
      $tags = $product->get_tag_ids();
      foreach ($tags as $tag_id) {
          $tag = get_term($tag_id, 'product_tag');
          $formatted_product['tags'][] = array(
              'id' => $tag->term_id,
              'name' => $tag->name,
              'slug' => $tag->slug,
              'image' => get_field('tag_image', 'product_tag_' . $tag_id),
          );
      }

      // Add attributes
      $attributes = $product->get_attributes();
      foreach ($attributes as $attribute) {
          $terms = $attribute->get_terms();
          $attribute_data = array(
              'name' => $attribute->get_name(),
              'options' => array(),
          );
          foreach ($terms as $term) {
              $attribute_data['options'][] = array(
                  'id' => $term->term_id,
                  'name' => $term->name,
                  'slug' => $term->slug,
                  'image' => get_field('term_image', $term),
              );
          }
          $formatted_product['attributes'][] = $attribute_data;
      }

      // Add ACF fields
      /*$acf_fields = array(
          'product_intensity',
          'product_acidity',
          'product_bitterness',
          'product_roasting',
          'product_body',
          'product_capsules',
          'product_imgpack',
          'product_imglogo',
          'visibility',
      );

      foreach ($acf_fields as $field) {
          $formatted_product[$field] = get_field($field, $product->get_id());
      }*/

      return $formatted_product;
  }
  
  public function check_api_key($request)
  {
        $api_key = $request->get_param('api_key');
        return $api_key === $this->api_key;
  }

  function should_show_product($product)
  {
      $visibility = get_field('visibility', $product->get_id());
      return $visibility === false || $visibility === null;
  }

  function get_products_by_attribute($request)
  {
    $attribute = $request['attribute'];
    $term = $request['term'];
    $products = wc_get_products(array('status' => 'publish', 'attribute' => $attribute, 'attribute_term' => $term));
    $formatted_products = array();

    foreach ($products as $product) {
        if ($this->should_show_product($product)) {
            $formatted_products[] = $this->format_product_data($product);
        }
    }

    return new WP_REST_Response($formatted_products, 200);
  }

  function get_products_by_category($request)
    {
        $category_id = $request['category_id'];

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_id,
                ),
            ),
        );

        $query = new WP_Query($args);
        $formatted_products = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());
                if ($product && $this->should_show_product($product)) {
                    $formatted_products[] = $this->format_product_data($product);
                }
            }
            wp_reset_postdata();
        }

        if (empty($formatted_products)) {
            error_log("No products found for category ID: " . $category_id);
            error_log("WP_Query args: " . print_r($args, true));
        }

        return new WP_REST_Response($formatted_products, 200);
    }
  function get_products_by_tag($request)
    {
        $tag_id = $request['tag_id'];

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_tag',
                    'field' => 'term_id',
                    'terms' => $tag_id,
                ),
            ),
        );

        $query = new WP_Query($args);
        $formatted_products = array();

        error_log("Total posts found for tag ID {$tag_id}: " . $query->found_posts);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());
                error_log("Processing product ID: " . get_the_ID());
                if ($product) {
                    $visibility = get_field('visibility', $product->get_id());
                    error_log("Product visibility: " . var_export($visibility, true));
                    if ($this->should_show_product($product)) {
                        $formatted_products[] = $this->format_product_data($product);
                    } else {
                        error_log("Product not shown due to visibility setting");
                    }
                } else {
                    error_log("Failed to get product object for ID: " . get_the_ID());
                }
            }
            wp_reset_postdata();
        }

        if (empty($formatted_products)) {
            error_log("No products found for tag ID: " . $tag_id);
            error_log("WP_Query args: " . print_r($args, true));
        }

        return new WP_REST_Response($formatted_products, 200);
    }

    public function get_filtered_products($request)
    {
        $category_id = $request->get_param('category_id');
        $attributes = $request->get_param('attributes');
        $acf_fields = $request->get_param('acf_fields');

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );

        // Add category filter
        if ($category_id) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_id,
            );
        }

        // Add attribute filters
        if (is_array($attributes)) {
            foreach ($attributes as $taxonomy => $terms) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms,
                );
            }
        }

        $query = new WP_Query($args);
        $formatted_products = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());

                if ($product && $this->should_show_product($product)) {
                    // Check ACF fields
                    $include_product = true;
                    if (is_array($acf_fields)) {
                        foreach ($acf_fields as $field => $value) {
                            $product_value = get_field($field, $product->get_id());
                            if ($product_value != $value) {
                                $include_product = false;
                                break;
                            }
                        }
                    }

                    if ($include_product) {
                        $formatted_products[] = $this->format_product_data($product);
                    }
                }
            }
            wp_reset_postdata();
        }
        return new WP_REST_Response($formatted_products, 200);
    }
}

new Custom_WooCommerce_API();

/*add_action( 'rest_api_init', function () {
    register_rest_route( 'wc/v3', '/products/category/(?P<slug>[^/]+)', array(
       'methods' => 'GET',
       'callback' => 'get_products_by_category',
     ) );
   } );
   
function get_products_by_category( $data ) {
     
    $p = wc_get_products(array('status' => 'publish', 'category' => $data['slug']));
    $products = array();     
      
    foreach ($p as $product) {       
       
    $products[] = $product->get_data();
       
    }
      
    return new WP_REST_Response($products, 200);
}*/