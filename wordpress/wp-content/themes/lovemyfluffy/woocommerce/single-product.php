<?php
/**
 * The Template for displaying all single products
 * LoveMyFluffy Custom Theme
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="single-product-page">
    <div class="container">

        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class('single-product-container', $product); ?>>

                <?php
                // Breadcrumbs
                if (function_exists('lovemyfluffy_breadcrumbs')) {
                    lovemyfluffy_breadcrumbs();
                }
                ?>

                <div class="product-main">
                    <div class="product-images">
                        <?php
                        // Product images
                        do_action('woocommerce_before_single_product_summary');
                        ?>

                        <div class="product-gallery-thumbnails">
                            <?php
                            global $product;
                            $attachment_ids = $product->get_gallery_image_ids();

                            if ($attachment_ids) {
                                foreach ($attachment_ids as $attachment_id) {
                                    echo '<div class="gallery-thumb">';
                                    echo wp_get_attachment_image($attachment_id, 'thumbnail');
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="product-summary">
                        <div class="summary-content">

                            <?php
                            // Display product categories
                            $categories = get_the_terms($product->get_id(), 'product_cat');
                            if ($categories && !is_wp_error($categories)) :
                            ?>
                                <div class="product-categories">
                                    <?php foreach ($categories as $category) : ?>
                                        <?php echo lovemyfluffy_get_pet_category_badge($category); ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <h1 class="entry-title product-title">
                                <?php the_title(); ?>
                            </h1>

                            <div class="product-rating-reviews">
                                <?php woocommerce_template_single_rating(); ?>
                            </div>

                            <div class="product-price">
                                <?php woocommerce_template_single_price(); ?>
                            </div>

                            <div class="product-description">
                                <?php woocommerce_template_single_excerpt(); ?>
                            </div>

                            <div class="product-meta-info">
                                <?php if ($product->get_sku()) : ?>
                                    <div class="product-sku">
                                        <strong>SKU:</strong> <?php echo $product->get_sku(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($product->is_in_stock()) : ?>
                                    <div class="stock-status in-stock">
                                        <span class="status-icon">✅</span>
                                        <span>In Stock - Ready to Ship</span>
                                    </div>
                                <?php else : ?>
                                    <div class="stock-status out-of-stock">
                                        <span class="status-icon">❌</span>
                                        <span>Out of Stock</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="product-form">
                                <?php woocommerce_template_single_add_to_cart(); ?>
                            </div>

                            <div class="product-sharing">
                                <h4>Share this product:</h4>
                                <div class="share-buttons">
                                    <a href="#" class="share-btn facebook">Facebook</a>
                                    <a href="#" class="share-btn twitter">Twitter</a>
                                    <a href="#" class="share-btn pinterest">Pinterest</a>
                                    <a href="#" class="share-btn email">Email</a>
                                </div>
                            </div>

                            <div class="pet-care-features">
                                <h4>Why Your Pet Will Love This:</h4>
                                <ul class="feature-list">
                                    <li>🏆 Premium Quality Materials</li>
                                    <li>🐾 Pet-Safe & Non-Toxic</li>
                                    <li>💯 Veterinarian Approved</li>
                                    <li>🚚 Fast & Free Shipping</li>
                                    <li>💖 30-Day Money Back Guarantee</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="product-details-tabs">
                    <?php
                    // Hook for adding content after the summary
                    do_action('woocommerce_after_single_product_summary');
                    ?>
                </div>

                <div class="size-guide-section">
                    <h3>Pet Size Guide</h3>
                    <div class="size-guide-content">
                        <div class="size-chart">
                            <table class="size-table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Weight Range</th>
                                        <th>Neck (inches)</th>
                                        <th>Chest (inches)</th>
                                        <th>Common Breeds</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>XS</td>
                                        <td>2-5 lbs</td>
                                        <td>6-8"</td>
                                        <td>8-12"</td>
                                        <td>Chihuahua, Yorkshire Terrier</td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td>6-15 lbs</td>
                                        <td>8-12"</td>
                                        <td>12-18"</td>
                                        <td>Pug, French Bulldog</td>
                                    </tr>
                                    <tr>
                                        <td>M</td>
                                        <td>16-40 lbs</td>
                                        <td>12-18"</td>
                                        <td>18-26"</td>
                                        <td>Beagle, Cocker Spaniel</td>
                                    </tr>
                                    <tr>
                                        <td>L</td>
                                        <td>41-70 lbs</td>
                                        <td>18-24"</td>
                                        <td>26-34"</td>
                                        <td>Golden Retriever, Border Collie</td>
                                    </tr>
                                    <tr>
                                        <td>XL</td>
                                        <td>71-100 lbs</td>
                                        <td>24-30"</td>
                                        <td>34-42"</td>
                                        <td>German Shepherd, Rottweiler</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="measuring-tips">
                            <h4>How to Measure Your Pet:</h4>
                            <ol>
                                <li>Use a soft measuring tape</li>
                                <li>Measure around the largest part of the chest</li>
                                <li>Measure around the base of the neck</li>
                                <li>When in doubt, size up for comfort</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="related-products-section">
                    <h3>You Might Also Like</h3>
                    <div class="related-products-grid">
                        <?php
                        // Get related products
                        $related_ids = wc_get_related_products($product->get_id(), 4);
                        if ($related_ids) {
                            foreach ($related_ids as $related_id) {
                                $related_product = wc_get_product($related_id);
                                if ($related_product) :
                        ?>
                                    <div class="related-product-item">
                                        <a href="<?php echo get_permalink($related_id); ?>">
                                            <?php echo $related_product->get_image('medium'); ?>
                                            <h4><?php echo $related_product->get_name(); ?></h4>
                                            <span class="price"><?php echo $related_product->get_price_html(); ?></span>
                                        </a>
                                    </div>
                        <?php
                                endif;
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="customer-reviews-section">
                    <h3>Customer Reviews</h3>
                    <div class="reviews-summary">
                        <div class="average-rating">
                            <span class="rating-number">4.8</span>
                            <div class="stars">★★★★★</div>
                            <span class="review-count">Based on 127 reviews</span>
                        </div>
                        <div class="rating-breakdown">
                            <div class="rating-bar">
                                <span>5★</span>
                                <div class="bar"><div class="fill" style="width: 85%"></div></div>
                                <span>85%</span>
                            </div>
                            <div class="rating-bar">
                                <span>4★</span>
                                <div class="bar"><div class="fill" style="width: 10%"></div></div>
                                <span>10%</span>
                            </div>
                            <div class="rating-bar">
                                <span>3★</span>
                                <div class="bar"><div class="fill" style="width: 3%"></div></div>
                                <span>3%</span>
                            </div>
                            <div class="rating-bar">
                                <span>2★</span>
                                <div class="bar"><div class="fill" style="width: 1%"></div></div>
                                <span>1%</span>
                            </div>
                            <div class="rating-bar">
                                <span>1★</span>
                                <div class="bar"><div class="fill" style="width: 1%"></div></div>
                                <span>1%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shipping-return-info">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">🚚</div>
                            <h4>Fast Shipping</h4>
                            <p>Free shipping on orders over $50. Express delivery available.</p>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">🔄</div>
                            <h4>Easy Returns</h4>
                            <p>30-day return policy. No questions asked if your pet doesn't love it.</p>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">🔒</div>
                            <h4>Secure Payment</h4>
                            <p>SSL encrypted checkout. Your payment information is always safe.</p>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">💬</div>
                            <h4>Pet Expert Support</h4>
                            <p>Have questions? Our pet care experts are here to help.</p>
                        </div>
                    </div>
                </div>

            </div>

        <?php endwhile; ?>

    </div>
</div>

<style>
/* Single Product Page Styles */
.single-product-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    padding: 2rem;
    margin: 2rem 0;
}

.product-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}

.product-images {
    position: relative;
}

.product-gallery-thumbnails {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
    overflow-x: auto;
}

.gallery-thumb {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-thumb:hover {
    transform: scale(1.1);
}

.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-categories {
    margin-bottom: 1rem;
}

.product-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.product-rating-reviews {
    margin-bottom: 1rem;
}

.product-price {
    font-size: 2rem;
    color: #ff6b9d;
    font-weight: bold;
    margin-bottom: 1.5rem;
}

.product-description {
    margin-bottom: 2rem;
    line-height: 1.6;
}

.product-meta-info {
    margin-bottom: 2rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.stock-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.stock-status.in-stock {
    color: #27ae60;
}

.stock-status.out-of-stock {
    color: #e74c3c;
}

.product-form {
    margin-bottom: 2rem;
}

.product-sharing {
    margin-bottom: 2rem;
}

.share-buttons {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.share-btn {
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
}

.share-btn.facebook { background: #3b5998; }
.share-btn.twitter { background: #1da1f2; }
.share-btn.pinterest { background: #bd081c; }
.share-btn.email { background: #333; }

.pet-care-features {
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    padding: 1.5rem;
    border-radius: 10px;
}

.feature-list {
    list-style: none;
    margin-top: 1rem;
}

.feature-list li {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.size-guide-section {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    margin-bottom: 3rem;
}

.size-guide-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-top: 1rem;
}

.size-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.size-table th,
.size-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.size-table th {
    background: #2c3e50;
    color: white;
}

.measuring-tips {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
}

.measuring-tips ol {
    margin-top: 1rem;
}

.measuring-tips li {
    margin-bottom: 0.5rem;
}

.related-products-section {
    margin-bottom: 3rem;
}

.related-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.related-product-item {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.related-product-item:hover {
    transform: translateY(-5px);
}

.related-product-item a {
    display: block;
    text-decoration: none;
    color: #333;
}

.related-product-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-product-item h4 {
    padding: 1rem 1rem 0.5rem;
    font-size: 1rem;
}

.related-product-item .price {
    padding: 0 1rem 1rem;
    color: #ff6b9d;
    font-weight: bold;
}

.customer-reviews-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.reviews-summary {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
    margin-top: 1rem;
}

.average-rating {
    text-align: center;
}

.rating-number {
    font-size: 3rem;
    font-weight: bold;
    color: #ff6b9d;
    display: block;
}

.stars {
    font-size: 1.5rem;
    color: #ffa500;
    margin: 0.5rem 0;
}

.rating-breakdown {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.rating-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.bar {
    flex: 1;
    height: 8px;
    background: #e0e0e0;
    border-radius: 4px;
    overflow: hidden;
}

.fill {
    height: 100%;
    background: #ffa500;
}

.shipping-return-info {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: white;
    padding: 2rem;
    border-radius: 15px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 1rem;
}

.info-item {
    text-align: center;
}

.info-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.info-item h4 {
    margin-bottom: 0.5rem;
    color: #ff6b9d;
}

@media (max-width: 768px) {
    .product-main {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .product-title {
        font-size: 2rem;
    }

    .size-guide-content {
        grid-template-columns: 1fr;
    }

    .reviews-summary {
        grid-template-columns: 1fr;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .share-buttons {
        flex-wrap: wrap;
    }
}
</style>

<?php
get_footer('shop');
?>