<?php
/**
 * Front Page Template - BACKUP
 * LoveMyFluffy Pet Supplies Homepage
 */

get_header(); ?>

<div class="homepage-container">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Welcome to LoveMyFluffy
                    <span class="loading-paw">🐾</span>
                </h1>
                <p class="hero-subtitle">Your one-stop shop for premium pet supplies and accessories</p>
                <p class="hero-description">
                    From nutritious food to engaging toys, we have everything your furry, feathered, or scaled friends need to live their best lives.
                </p>
                <div class="hero-actions">
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-primary">
                        Shop Now
                    </a>
                    <a href="#featured-categories" class="btn-secondary">
                        Browse Categories
                    </a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">10,000+</span>
                    <span class="stat-label">Happy Pets</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Products</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4.8⭐</span>
                    <span class="stat-label">Average Rating</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section -->
    <section id="featured-categories" class="featured-categories-section">
        <div class="container">
            <h2 class="section-title">Shop by Pet Type</h2>
            <p class="section-subtitle">Find exactly what your pet needs</p>

            <div class="categories-grid">
                <?php
                // Get or create pet categories
                $pet_categories = array(
                    array(
                        'name' => 'Dogs',
                        'description' => 'Premium food, toys, and accessories for your loyal companion',
                        'icon' => '🐕',
                        'color' => 'pet-dogs',
                        'image' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400'
                    ),
                    array(
                        'name' => 'Cats',
                        'description' => 'Everything your independent feline friend desires',
                        'icon' => '🐱',
                        'color' => 'pet-cats',
                        'image' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400'
                    ),
                    array(
                        'name' => 'Birds',
                        'description' => 'Seeds, cages, and toys for your feathered friends',
                        'icon' => '🐦',
                        'color' => 'pet-birds',
                        'image' => 'https://images.unsplash.com/photo-1452570053594-1b985d6ea890?w=400'
                    ),
                    array(
                        'name' => 'Fish',
                        'description' => 'Aquarium supplies and nutrition for aquatic pets',
                        'icon' => '🐠',
                        'color' => 'pet-fish',
                        'image' => 'https://images.unsplash.com/photo-1544943503-317e6db49ac0?w=400'
                    ),
                    array(
                        'name' => 'Small Pets',
                        'description' => 'Supplies for hamsters, rabbits, guinea pigs, and more',
                        'icon' => '🐹',
                        'color' => 'pet-small-pets',
                        'image' => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=400'
                    )
                );

                foreach ($pet_categories as $category) :
                    // Try to get the actual category
                    $category_obj = get_term_by('name', $category['name'], 'product_cat');
                    $category_link = $category_obj ? get_term_link($category_obj) : get_permalink(wc_get_page_id('shop'));

                    // Count products in category
                    $product_count = $category_obj ? $category_obj->count : 0;
                ?>
                    <div class="category-card <?php echo esc_attr($category['color']); ?>">
                        <div class="category-image">
                            <img src="<?php echo esc_url($category['image']); ?>" alt="<?php echo esc_attr($category['name']); ?>">
                            <div class="category-overlay">
                                <span class="category-icon"><?php echo $category['icon']; ?></span>
                            </div>
                        </div>
                        <div class="category-content">
                            <h3 class="category-title"><?php echo esc_html($category['name']); ?></h3>
                            <p class="category-description"><?php echo esc_html($category['description']); ?></p>
                            <div class="category-meta">
                                <span class="product-count"><?php echo $product_count; ?> products</span>
                            </div>
                            <a href="<?php echo esc_url($category_link); ?>" class="category-link">
                                Shop <?php echo esc_html($category['name']); ?>
                                <span class="arrow">→</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Hand-picked favorites for your beloved pets</p>

            <div class="products-slider">
                <?php
                // Get some products to display
                $featured_products = get_posts(array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'orderby' => 'rand'
                ));

                if ($featured_products) :
                    foreach ($featured_products as $product_post) :
                        $product = wc_get_product($product_post->ID);
                        if (!$product) continue;
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
                                <h3 class="product-title">
                                    <a href="<?php echo get_permalink($product->get_id()); ?>">
                                        <?php echo $product->get_name(); ?>
                                    </a>
                                </h3>
                                <div class="product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                                <div class="product-rating">
                                    ⭐⭐⭐⭐⭐ <span class="rating-text">(4.8)</span>
                                </div>
                                <a href="<?php echo $product->add_to_cart_url(); ?>" class="add-to-cart-btn">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                <?php
                    endforeach;
                else :
                ?>
                    <div class="no-products">
                        <p>No products available yet. <a href="<?php echo admin_url('edit.php?post_type=product'); ?>">Add some products</a> to get started!</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="section-actions">
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-outline">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us-section">
        <div class="container">
            <h2 class="section-title">Why Pet Owners Choose LoveMyFluffy</h2>

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

                <div class="feature-item">
                    <div class="feature-icon">📞</div>
                    <h3>Expert Support</h3>
                    <p>Our pet care experts are available 24/7 to help you choose the right products for your pet.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">💚</div>
                    <h3>Eco-Friendly</h3>
                    <p>Sustainable and environmentally responsible products that are safe for pets and the planet.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Stay Connected with LoveMyFluffy</h2>
                <p>Get the latest pet care tips, product updates, and exclusive offers delivered to your inbox.</p>

                <form class="newsletter-form">
                    <div class="form-group">
                        <input type="email" placeholder="Enter your email address" class="email-input" required>
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </div>
                    <p class="form-note">We respect your privacy. Unsubscribe at any time.</p>
                </form>

                <div class="social-proof">
                    <p>Join 50,000+ pet lovers who trust LoveMyFluffy</p>
                    <div class="customer-avatars">
                        <span class="avatar">🐕</span>
                        <span class="avatar">🐱</span>
                        <span class="avatar">🐦</span>
                        <span class="avatar">🐠</span>
                        <span class="avatar">🐹</span>
                        <span class="more">+50k</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
/* Homepage Specific Styles */
.homepage-container {
    overflow-x: hidden;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    padding: 4rem 0;
    text-align: center;
    position: relative;
}

.hero-title {
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
    margin-bottom: 3rem;
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

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Featured Categories */
.featured-categories-section {
    padding: 4rem 0;
    background: #f8f9fa;
}

.section-title {
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

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.category-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.category-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.category-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-icon {
    font-size: 2rem;
}

.category-content {
    padding: 1.5rem;
}

.category-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.category-description {
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.category-meta {
    margin-bottom: 1rem;
}

.product-count {
    background: #ff6b9d;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.9rem;
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

/* Featured Products */
.featured-products-section {
    padding: 4rem 0;
}

.products-slider {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

.product-image {
    position: relative;
    height: 200px;
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

.product-info {
    padding: 1.5rem;
}

.product-title {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.product-title a {
    color: #2c3e50;
    text-decoration: none;
}

.product-price {
    font-size: 1.3rem;
    font-weight: bold;
    color: #ff6b9d;
    margin-bottom: 0.5rem;
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
    text-align: center;
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

/* Why Choose Us */
.why-choose-us-section {
    padding: 4rem 0;
    background: #f8f9fa;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-item {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.feature-item h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.feature-item p {
    color: #666;
    line-height: 1.6;
}

/* Newsletter */
.newsletter-section {
    padding: 4rem 0;
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: white;
    text-align: center;
}

.newsletter-content h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.newsletter-content p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.newsletter-form {
    max-width: 500px;
    margin: 0 auto 2rem;
}

.form-group {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.email-input {
    flex: 1;
    padding: 1rem;
    border-radius: 25px;
    border: none;
    font-size: 1rem;
}

.newsletter-btn {
    background: #ff6b9d;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.newsletter-btn:hover {
    background: #c44569;
}

.form-note {
    font-size: 0.9rem;
    opacity: 0.8;
}

.customer-avatars {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.avatar {
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.more {
    background: #ff6b9d;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .hero-stats {
        gap: 1.5rem;
    }

    .categories-grid {
        grid-template-columns: 1fr;
    }

    .products-slider {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .features-grid {
        grid-template-columns: 1fr;
    }

    .form-group {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>