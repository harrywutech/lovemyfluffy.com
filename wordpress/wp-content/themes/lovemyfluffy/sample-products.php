<?php
/**
 * Sample Pet Products Creator
 * Run this script once to populate the store with sample products
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function lovemyfluffy_create_sample_products() {
    // Check if products already exist
    $existing_products = get_posts(array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => 1
    ));

    if (!empty($existing_products)) {
        return; // Products already exist
    }

    // Sample products data
    $sample_products = array(
        // DOG PRODUCTS
        array(
            'name' => 'Premium Dog Food - Chicken & Rice',
            'description' => 'High-quality dry dog food made with real chicken and brown rice. Perfect for adult dogs of all sizes. Contains essential vitamins and minerals for optimal health.',
            'short_description' => 'Premium dry dog food with real chicken and brown rice for adult dogs.',
            'price' => '49.99',
            'sale_price' => '39.99',
            'categories' => array('Dogs'),
            'tags' => array('food', 'dry-food', 'chicken', 'adult-dogs'),
            'sku' => 'DOG-FOOD-001',
            'stock' => 50,
            'image_url' => 'https://images.unsplash.com/photo-1589924691995-400dc9ecc119?w=400'
        ),
        array(
            'name' => 'Interactive Dog Puzzle Toy',
            'description' => 'Keep your dog mentally stimulated with this challenging puzzle toy. Features multiple compartments for treats and encourages problem-solving skills.',
            'short_description' => 'Mental stimulation puzzle toy for dogs with treat compartments.',
            'price' => '24.99',
            'categories' => array('Dogs'),
            'tags' => array('toys', 'puzzle', 'mental-stimulation', 'treats'),
            'sku' => 'DOG-TOY-001',
            'stock' => 25,
            'image_url' => 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?w=400'
        ),
        array(
            'name' => 'Adjustable Dog Collar - Leather',
            'description' => 'Premium genuine leather collar with adjustable buckle. Comfortable and durable for daily wear. Available in multiple sizes.',
            'short_description' => 'Premium genuine leather adjustable dog collar.',
            'price' => '19.99',
            'categories' => array('Dogs'),
            'tags' => array('collar', 'leather', 'adjustable', 'accessories'),
            'sku' => 'DOG-COL-001',
            'stock' => 40,
            'image_url' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400'
        ),

        // CAT PRODUCTS
        array(
            'name' => 'Natural Cat Litter - Clumping',
            'description' => 'All-natural clumping cat litter made from bentonite clay. Controls odors naturally and is easy to scoop. Safe for cats and environmentally friendly.',
            'short_description' => 'All-natural clumping cat litter with odor control.',
            'price' => '16.99',
            'categories' => array('Cats'),
            'tags' => array('litter', 'clumping', 'natural', 'odor-control'),
            'sku' => 'CAT-LIT-001',
            'stock' => 30,
            'image_url' => 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=400'
        ),
        array(
            'name' => 'Catnip Mouse Toy Set (3-Pack)',
            'description' => 'Set of three adorable catnip-filled mouse toys. Made with premium catnip that drives cats wild. Perfect size for batting, carrying, and pouncing.',
            'short_description' => 'Three catnip-filled mouse toys for endless cat entertainment.',
            'price' => '12.99',
            'categories' => array('Cats'),
            'tags' => array('toys', 'catnip', 'mice', 'set'),
            'sku' => 'CAT-TOY-001',
            'stock' => 35,
            'image_url' => 'https://images.unsplash.com/photo-1574144611937-0df059b5ef3e?w=400'
        ),
        array(
            'name' => 'Multi-Level Cat Tree',
            'description' => 'Large cat tree with multiple levels, scratching posts, and cozy hideouts. Perfect for multi-cat households. Sturdy construction with carpet covering.',
            'short_description' => 'Multi-level cat tree with scratching posts and hideouts.',
            'price' => '89.99',
            'sale_price' => '74.99',
            'categories' => array('Cats'),
            'tags' => array('cat-tree', 'scratching', 'furniture', 'multi-level'),
            'sku' => 'CAT-TREE-001',
            'stock' => 15,
            'image_url' => 'https://images.unsplash.com/photo-1545249390-6bdfa286032f?w=400'
        ),

        // BIRD PRODUCTS
        array(
            'name' => 'Premium Bird Seed Mix',
            'description' => 'Nutritious seed blend perfect for songbirds, finches, and canaries. Contains sunflower seeds, millet, and other essential nutrients.',
            'short_description' => 'Premium seed mix for songbirds, finches, and canaries.',
            'price' => '13.99',
            'categories' => array('Birds'),
            'tags' => array('food', 'seeds', 'songbirds', 'finches'),
            'sku' => 'BIRD-FOOD-001',
            'stock' => 45,
            'image_url' => 'https://images.unsplash.com/photo-1452570053594-1b985d6ea890?w=400'
        ),
        array(
            'name' => 'Wooden Bird Perch Set',
            'description' => 'Set of natural wooden perches in various sizes. Helps maintain healthy feet and provides enrichment for pet birds.',
            'short_description' => 'Natural wooden perch set for healthy bird feet.',
            'price' => '18.99',
            'categories' => array('Birds'),
            'tags' => array('perches', 'wooden', 'natural', 'accessories'),
            'sku' => 'BIRD-PER-001',
            'stock' => 28,
            'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400'
        ),

        // FISH PRODUCTS
        array(
            'name' => 'Tropical Fish Flakes',
            'description' => 'Complete nutrition for tropical fish. Contains spirulina and other essential nutrients for vibrant colors and healthy growth.',
            'short_description' => 'Complete nutrition flakes for tropical fish with spirulina.',
            'price' => '8.99',
            'categories' => array('Fish'),
            'tags' => array('food', 'flakes', 'tropical', 'nutrition'),
            'sku' => 'FISH-FOOD-001',
            'stock' => 60,
            'image_url' => 'https://images.unsplash.com/photo-1544943503-317e6db49ac0?w=400'
        ),
        array(
            'name' => 'Aquarium Castle Decoration',
            'description' => 'Beautiful medieval castle decoration for aquariums. Safe for fish and provides hiding spots. Enhances the visual appeal of any tank.',
            'short_description' => 'Medieval castle decoration with hiding spots for fish.',
            'price' => '22.99',
            'categories' => array('Fish'),
            'tags' => array('decoration', 'castle', 'aquarium', 'hiding'),
            'sku' => 'FISH-DEC-001',
            'stock' => 20,
            'image_url' => 'https://images.unsplash.com/photo-1520637836862-4d197d17c13a?w=400'
        ),

        // SMALL PETS PRODUCTS
        array(
            'name' => 'Hamster Exercise Wheel',
            'description' => 'Silent spinning exercise wheel perfect for hamsters, gerbils, and mice. Solid running surface prevents injury and promotes healthy exercise.',
            'short_description' => 'Silent exercise wheel for hamsters and small pets.',
            'price' => '15.99',
            'categories' => array('Small Pets'),
            'tags' => array('exercise', 'wheel', 'hamster', 'silent'),
            'sku' => 'SMALL-EX-001',
            'stock' => 32,
            'image_url' => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=400'
        ),
        array(
            'name' => 'Small Pet Bedding - Paper Based',
            'description' => 'Ultra-soft, absorbent bedding made from recycled paper. Safe for all small pets and controls odors naturally.',
            'short_description' => 'Ultra-soft paper-based bedding for small pets.',
            'price' => '11.99',
            'categories' => array('Small Pets'),
            'tags' => array('bedding', 'paper', 'absorbent', 'odor-control'),
            'sku' => 'SMALL-BED-001',
            'stock' => 25,
            'image_url' => 'https://images.unsplash.com/photo-1548681528-6a5c45b66b42?w=400'
        )
    );

    foreach ($sample_products as $product_data) {
        // Create the product
        $product_id = wp_insert_post(array(
            'post_title' => $product_data['name'],
            'post_content' => $product_data['description'],
            'post_excerpt' => $product_data['short_description'],
            'post_status' => 'publish',
            'post_type' => 'product',
            'post_author' => 1
        ));

        if ($product_id) {
            // Set product meta
            update_post_meta($product_id, '_price', $product_data['price']);
            update_post_meta($product_id, '_regular_price', $product_data['price']);

            if (isset($product_data['sale_price'])) {
                update_post_meta($product_id, '_sale_price', $product_data['sale_price']);
            }

            update_post_meta($product_id, '_sku', $product_data['sku']);
            update_post_meta($product_id, '_manage_stock', 'yes');
            update_post_meta($product_id, '_stock', $product_data['stock']);
            update_post_meta($product_id, '_stock_status', 'instock');
            update_post_meta($product_id, '_visibility', 'visible');
            update_post_meta($product_id, '_featured', 'no');
            update_post_meta($product_id, '_sold_individually', 'no');
            update_post_meta($product_id, '_virtual', 'no');
            update_post_meta($product_id, '_downloadable', 'no');

            // Assign categories
            foreach ($product_data['categories'] as $category_name) {
                $category = get_term_by('name', $category_name, 'product_cat');
                if ($category) {
                    wp_set_post_terms($product_id, array($category->term_id), 'product_cat');
                }
            }

            // Assign tags
            if (isset($product_data['tags'])) {
                wp_set_post_terms($product_id, $product_data['tags'], 'product_tag');
            }

            // Set featured image (you would normally upload actual images)
            // For demo purposes, we're just storing the URL as meta
            if (isset($product_data['image_url'])) {
                update_post_meta($product_id, '_product_image_url', $product_data['image_url']);
            }

            // Update post to trigger WooCommerce hooks
            wp_update_post(array('ID' => $product_id));
        }
    }

    // Create some featured products
    $featured_products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => 3,
        'orderby' => 'rand'
    ));

    foreach ($featured_products as $featured) {
        update_post_meta($featured->ID, '_featured', 'yes');
    }
}

// Hook to run when theme is activated
add_action('after_switch_theme', 'lovemyfluffy_create_sample_products');

// Also provide a function to run manually
function lovemyfluffy_admin_create_products() {
    if (isset($_GET['create_sample_products']) && current_user_can('manage_options')) {
        lovemyfluffy_create_sample_products();
        wp_redirect(admin_url('edit.php?post_type=product&products_created=1'));
        exit;
    }
}
add_action('admin_init', 'lovemyfluffy_admin_create_products');

// Add admin notice
function lovemyfluffy_sample_products_notice() {
    if (isset($_GET['products_created'])) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>Sample pet products have been created successfully!</p>';
        echo '</div>';
    }

    $existing_products = get_posts(array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => 1
    ));

    if (empty($existing_products) && current_user_can('manage_options')) {
        echo '<div class="notice notice-info">';
        echo '<p>No products found. <a href="' . admin_url('edit.php?post_type=product&create_sample_products=1') . '">Create sample pet products</a> to get started!</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'lovemyfluffy_sample_products_notice');
?>