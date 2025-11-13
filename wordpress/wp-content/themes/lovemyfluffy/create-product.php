<?php
/**
 * Add this to functions.php to create a test product automatically
 */

add_action('init', 'create_test_dog_product_once');

function create_test_dog_product_once() {
    // Check if we've already created the test product
    if (get_option('test_dog_product_created')) {
        return;
    }

    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Create a new product
    $product = new WC_Product_Simple();

    // Set product data
    $product->set_name('Premium Dog Food - Chicken & Rice');
    $product->set_slug('premium-dog-food-chicken-rice');
    $product->set_regular_price('29.99');
    $product->set_sale_price('24.99');
    $product->set_description('High-quality premium dog food made with real chicken and brown rice. Perfect for adult dogs of all sizes. Rich in protein and essential nutrients for healthy growth and energy.');
    $product->set_short_description('Premium dog food with real chicken and brown rice for adult dogs.');
    $product->set_sku('DOG-FOOD-001');
    $product->set_manage_stock(true);
    $product->set_stock_quantity(100);
    $product->set_stock_status('instock');
    $product->set_catalog_visibility('visible');
    $product->set_featured(true);
    $product->set_virtual(false);
    $product->set_downloadable(false);
    $product->set_sold_individually(false);
    $product->set_weight('5'); // 5 lbs
    $product->set_length('10');
    $product->set_width('6');
    $product->set_height('4');

    // Set product status
    $product->set_status('publish');

    // Save the product
    $product_id = $product->save();

    if ($product_id) {
        // Get the Dogs category
        $dogs_category = get_term_by('name', 'Dogs', 'product_cat');

        if ($dogs_category) {
            // Assign to Dogs category
            wp_set_object_terms($product_id, array($dogs_category->term_id), 'product_cat');
        }

        // Add some product tags
        wp_set_object_terms($product_id, array('premium', 'chicken', 'rice', 'adult-dogs'), 'product_tag');

        // Enable reviews
        update_post_meta($product_id, '_reviews_allowed', 'yes');

        // Mark as created so we don't create it again
        update_option('test_dog_product_created', true);
        update_option('test_dog_product_id', $product_id);
    }
}
?>