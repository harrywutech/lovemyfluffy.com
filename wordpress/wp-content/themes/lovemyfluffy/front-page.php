<?php
/**
 * Front Page Template - LoveMyFluffy Pet Supplies
 * Working version with proper WordPress structure
 */

get_header(); ?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to LoveMyFluffy 🐾</h1>
            <p class="hero-subtitle">Your one-stop shop for premium pet supplies and accessories</p>
            <p class="hero-description">
                From nutritious food to engaging toys, we have everything your furry, feathered, or scaled friends need to live their best lives.
            </p>
            <div class="hero-actions">
                <?php if (class_exists('WooCommerce') && function_exists('wc_get_page_id')) : ?>
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-primary">
                        Shop Now
                    </a>
                <?php endif; ?>
                <a href="#featured-categories" class="btn-secondary">
                    Browse Categories
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section id="featured-categories" class="featured-categories">
        <div class="container">
            <h2>Shop by Pet Type</h2>
            <p class="section-subtitle">Find exactly what your pet needs</p>

            <div class="categories-grid">
                <?php
                $pet_categories = array(
                    'Dogs' => array('icon' => '🐕', 'color' => 'pet-dogs'),
                    'Cats' => array('icon' => '🐱', 'color' => 'pet-cats'),
                    'Birds' => array('icon' => '🐦', 'color' => 'pet-birds'),
                    'Fish' => array('icon' => '🐠', 'color' => 'pet-fish'),
                    'Small Pets' => array('icon' => '🐹', 'color' => 'pet-small-pets')
                );

                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ));

                if ($categories && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                        $category_link = get_term_link($category);
                        $pet_info = isset($pet_categories[$category->name]) ? $pet_categories[$category->name] : array('icon' => '🐾', 'color' => 'pet-general');
                        if (!is_wp_error($category_link)) :
                ?>
                    <div class="category-card <?php echo esc_attr($pet_info['color']); ?>">
                        <div class="category-icon"><?php echo $pet_info['icon']; ?></div>
                        <h3><?php echo esc_html($category->name); ?></h3>
                        <p class="product-count"><?php echo $category->count; ?> products</p>
                        <a href="<?php echo esc_url($category_link); ?>" class="category-link">
                            Shop <?php echo esc_html($category->name); ?>
                            <span class="arrow">→</span>
                        </a>
                    </div>
                <?php
                        endif;
                    endforeach;
                else :
                ?>
                    <div class="no-categories">
                        <p>No categories found. <a href="<?php echo admin_url('edit-tags.php?taxonomy=product_cat&post_type=product'); ?>">Add some categories</a> to get started!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2>Featured Products</h2>
            <p class="section-subtitle">Hand-picked favorites for your beloved pets</p>

            <div class="products-grid">
                <?php
                $products = get_posts(array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'orderby' => 'date'
                ));

                if ($products) :
                    foreach ($products as $product_post) :
                        $product = function_exists('wc_get_product') ? wc_get_product($product_post->ID) : null;
                        if ($product) :
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?php echo get_permalink($product->get_id()); ?>">
                                <?php echo $product->get_image('medium'); ?>
                            </a>
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="sale-badge">Sale!</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3>
                            <div class="product-price"><?php echo $product->get_price_html(); ?></div>
                            <div class="product-rating">⭐⭐⭐⭐⭐ <span class="rating-text">(4.8)</span></div>
                            <a href="<?php echo $product->add_to_cart_url(); ?>" class="add-to-cart-btn">Add to Cart</a>
                        </div>
                    </div>
                <?php
                        endif;
                    endforeach;
                else :
                ?>
                    <div class="no-products">
                        <p>No products found. <a href="<?php echo admin_url('edit.php?post_type=product'); ?>">Add some products</a> to get started!</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="section-actions">
                <?php if (class_exists('WooCommerce') && function_exists('wc_get_page_id')) : ?>
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-outline">
                        View All Products
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-us">
        <div class="container">
            <h2>Why Pet Owners Choose LoveMyFluffy</h2>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🏆</div>
                    <h3>Premium Quality</h3>
                    <p>Only the highest quality products that meet our strict standards for pet safety and durability.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">🚚</div>
                    <h3>Fast & Free Shipping</h3>
                    <p>Free shipping on orders over $50 with express delivery options available nationwide.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">💯</div>
                    <h3>30-Day Guarantee</h3>
                    <p>Not satisfied? Return any item within 30 days for a full refund, no questions asked.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">🩺</div>
                    <h3>Vet Approved</h3>
                    <p>All our products are recommended and approved by veterinarians for pet health and safety.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
/* LoveMyFluffy Homepage Styles */
.hero-section {
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    padding: 4rem 0;
    text-align: center;
}

.hero-section h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    opacity: 0.95;
}

.hero-description {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    opacity: 0.9;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 1rem 2rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-primary {
    background: white;
    color: #c44569;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-secondary:hover {
    background: white;
    color: #c44569;
}

.featured-categories, .featured-products {
    padding: 4rem 0;
}

.featured-categories {
    background: #f8f9fa;
}

.why-choose-us {
    padding: 4rem 0;
    background: #f8f9fa;
}

h2 {
    text-align: center;
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.section-subtitle {
    text-align: center;
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 3rem;
}

.categories-grid, .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.category-card, .product-card, .feature-item {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    text-align: center;
    transition: all 0.3s ease;
}

.category-card:hover, .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

.category-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.category-card h3, .product-card h3, .feature-item h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.product-count {
    background: #ff6b9d;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: inline-block;
}

.category-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #ff6b9d;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.category-link:hover {
    color: #c44569;
}

.product-image {
    position: relative;
    height: 200px;
    margin-bottom: 1rem;
    overflow: hidden;
    border-radius: 10px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sale-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #e74c3c;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: bold;
}

.product-info a {
    color: inherit;
    text-decoration: none;
}

.product-price {
    font-size: 1.3rem;
    font-weight: bold;
    color: #ff6b9d;
    margin: 0.5rem 0;
}

.product-rating {
    margin-bottom: 1rem;
    color: #ffa500;
}

.rating-text {
    color: #666;
    font-size: 0.9rem;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    display: inline-block;
    width: 100%;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.section-actions {
    text-align: center;
}

.btn-outline {
    background: transparent;
    color: #ff6b9d;
    border: 2px solid #ff6b9d;
    padding: 1rem 2rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    background: #ff6b9d;
    color: white;
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.feature-item p {
    color: #666;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .categories-grid, .products-grid {
        grid-template-columns: 1fr;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>