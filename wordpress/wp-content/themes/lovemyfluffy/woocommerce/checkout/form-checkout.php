<?php
/**
 * Checkout Form
 * LoveMyFluffy Custom Theme
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>

<div class="lovemyfluffy-checkout-container">
    <div class="container">

        <div class="checkout-header">
            <h1 class="checkout-title">
                Secure Checkout <span class="loading-paw">🐾</span>
            </h1>
            <div class="checkout-progress">
                <div class="progress-step active">
                    <span class="step-number">1</span>
                    <span class="step-label">Shipping</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">2</span>
                    <span class="step-label">Payment</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">3</span>
                    <span class="step-label">Complete</span>
                </div>
            </div>
        </div>

        <div class="security-badges">
            <div class="security-badge">
                <span class="badge-icon">🔒</span>
                <span>SSL Secured</span>
            </div>
            <div class="security-badge">
                <span class="badge-icon">💳</span>
                <span>Secure Payment</span>
            </div>
            <div class="security-badge">
                <span class="badge-icon">🚚</span>
                <span>Fast Shipping</span>
            </div>
            <div class="security-badge">
                <span class="badge-icon">🐾</span>
                <span>Pet Safe</span>
            </div>
        </div>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

            <div class="checkout-main">
                <div class="checkout-form-section">
                    <div class="checkout-step billing-step">
                        <h2 class="step-title">
                            <span class="step-icon">📍</span>
                            Shipping Information
                        </h2>

                        <?php if ($checkout->get_checkout_fields()) : ?>
                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                            <div class="customer-details">
                                <div class="billing-fields">
                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                </div>

                                <div class="shipping-fields">
                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                </div>
                            </div>

                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                        <?php endif; ?>

                        <div class="pet-delivery-options">
                            <h3>Special Delivery Instructions for Your Pet</h3>
                            <div class="delivery-options">
                                <label class="delivery-option">
                                    <input type="checkbox" name="safe_delivery" value="1">
                                    <span class="checkmark"></span>
                                    <div class="option-content">
                                        <strong>Pet-Safe Delivery</strong>
                                        <p>Leave in secure location away from pets</p>
                                    </div>
                                </label>

                                <label class="delivery-option">
                                    <input type="checkbox" name="fragile_items" value="1">
                                    <span class="checkmark"></span>
                                    <div class="option-content">
                                        <strong>Fragile Items</strong>
                                        <p>Handle with extra care (toys, treats, etc.)</p>
                                    </div>
                                </label>

                                <label class="delivery-option">
                                    <input type="checkbox" name="temperature_sensitive" value="1">
                                    <span class="checkmark"></span>
                                    <div class="option-content">
                                        <strong>Temperature Sensitive</strong>
                                        <p>Keep cool/dry (food, medications)</p>
                                    </div>
                                </label>
                            </div>

                            <div class="special-instructions">
                                <label for="delivery_notes">Special Delivery Notes:</label>
                                <textarea id="delivery_notes" name="delivery_notes" placeholder="Any special instructions for delivering your pet supplies..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-step payment-step">
                        <h2 class="step-title">
                            <span class="step-icon">💳</span>
                            Payment Information
                        </h2>

                        <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                        <div class="payment-methods">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>
                    </div>
                </div>

                <div class="checkout-sidebar">
                    <div class="order-summary-card">
                        <h3 class="summary-title">
                            <span class="summary-icon">🛒</span>
                            Order Summary
                        </h3>

                        <div class="cart-items">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            ?>
                                    <div class="cart-item">
                                        <div class="item-image">
                                            <?php echo $_product->get_image('thumbnail'); ?>
                                            <span class="item-quantity"><?php echo $cart_item['quantity']; ?></span>
                                        </div>
                                        <div class="item-details">
                                            <h4 class="item-name"><?php echo $_product->get_name(); ?></h4>
                                            <div class="item-meta">
                                                <?php
                                                // Display product categories
                                                $categories = get_the_terms($_product->get_id(), 'product_cat');
                                                if ($categories && !is_wp_error($categories)) {
                                                    foreach ($categories as $category) {
                                                        echo '<span class="item-category">' . esc_html($category->name) . '</span>';
                                                        break; // Show only first category
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="item-price">
                                            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="order-totals">
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span><?php wc_cart_totals_subtotal_html(); ?></span>
                            </div>

                            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                                <div class="total-row">
                                    <span>Shipping:</span>
                                    <span><?php wc_cart_totals_shipping_html(); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                                <div class="total-row">
                                    <span>Tax:</span>
                                    <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="total-row final-total">
                                <span>Total:</span>
                                <span><?php wc_cart_totals_order_total_html(); ?></span>
                            </div>
                        </div>

                        <div class="shipping-estimate">
                            <h4>🚚 Estimated Delivery</h4>
                            <p class="delivery-date">
                                <strong><?php echo date('M j', strtotime('+3 days')); ?> - <?php echo date('M j', strtotime('+5 days')); ?></strong>
                            </p>
                            <p class="delivery-note">Free shipping on orders over $50</p>
                        </div>

                        <div class="checkout-benefits">
                            <h4>Your Pet Gets:</h4>
                            <ul class="benefits-list">
                                <li>✅ Premium quality guarantee</li>
                                <li>🐾 Pet-safe materials only</li>
                                <li>💯 30-day return policy</li>
                                <li>📞 Expert pet care support</li>
                            </ul>
                        </div>
                    </div>

                    <div class="trust-signals">
                        <div class="trust-item">
                            <span class="trust-icon">🏆</span>
                            <div>
                                <strong>Award Winning</strong>
                                <small>Best Pet Retailer 2024</small>
                            </div>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">⭐</span>
                            <div>
                                <strong>4.8/5 Rating</strong>
                                <small>10,000+ Happy Customers</small>
                            </div>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">🔒</span>
                            <div>
                                <strong>Secure & Safe</strong>
                                <small>SSL Encrypted Checkout</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    </div>
</div>

<style>
/* Custom Checkout Styles */
.lovemyfluffy-checkout-container {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    min-height: 100vh;
    padding: 2rem 0;
}

.checkout-header {
    text-align: center;
    margin-bottom: 2rem;
}

.checkout-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.checkout-progress {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ddd;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.progress-step.active .step-number {
    background: #ff6b9d;
    color: white;
}

.step-label {
    font-size: 0.9rem;
    color: #666;
}

.progress-step.active .step-label {
    color: #ff6b9d;
    font-weight: bold;
}

.security-badges {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.security-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    color: #2c3e50;
}

.badge-icon {
    font-size: 1.2rem;
}

.checkout-main {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    align-items: start;
}

.checkout-form-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.checkout-step {
    margin-bottom: 3rem;
}

.step-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #ff6b9d;
}

.step-icon {
    font-size: 1.5rem;
}

.customer-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.pet-delivery-options {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.pet-delivery-options h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.delivery-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.delivery-option {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.delivery-option:hover {
    background: #fff5f8;
    border-color: #ff6b9d;
}

.delivery-option input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    border-radius: 4px;
    position: relative;
}

.delivery-option input[type="checkbox"]:checked + .checkmark {
    background: #ff6b9d;
    border-color: #ff6b9d;
}

.delivery-option input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    color: white;
    font-weight: bold;
    top: -2px;
    left: 3px;
}

.option-content strong {
    display: block;
    color: #2c3e50;
    margin-bottom: 0.3rem;
}

.option-content p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

.special-instructions textarea {
    width: 100%;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
    min-height: 80px;
    margin-top: 0.5rem;
}

.checkout-sidebar {
    position: sticky;
    top: 2rem;
}

.order-summary-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.summary-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #ff6b9d;
}

.summary-icon {
    font-size: 1.3rem;
}

.cart-items {
    margin-bottom: 2rem;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.cart-item:last-child {
    border-bottom: none;
}

.item-image {
    position: relative;
    flex-shrink: 0;
}

.item-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.item-quantity {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #ff6b9d;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
}

.item-details {
    flex: 1;
}

.item-name {
    font-size: 1rem;
    color: #2c3e50;
    margin-bottom: 0.3rem;
}

.item-category {
    background: #ff6b9d;
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    font-size: 0.8rem;
}

.item-price {
    font-weight: bold;
    color: #ff6b9d;
}

.order-totals {
    border-top: 2px solid #f0f0f0;
    padding-top: 1rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.8rem;
}

.final-total {
    font-size: 1.2rem;
    font-weight: bold;
    color: #2c3e50;
    border-top: 1px solid #ddd;
    padding-top: 0.8rem;
    margin-top: 0.8rem;
}

.shipping-estimate {
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    padding: 1.5rem;
    border-radius: 10px;
    margin: 2rem 0;
    text-align: center;
}

.shipping-estimate h4 {
    margin-bottom: 0.5rem;
}

.delivery-date {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.delivery-note {
    font-size: 0.9rem;
    opacity: 0.9;
}

.checkout-benefits {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
}

.benefits-list {
    list-style: none;
    margin-top: 1rem;
}

.benefits-list li {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.trust-signals {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.trust-item:last-child {
    margin-bottom: 0;
}

.trust-icon {
    font-size: 1.5rem;
}

.trust-item strong {
    display: block;
    color: #2c3e50;
}

.trust-item small {
    color: #666;
    font-size: 0.8rem;
}

@media (max-width: 1024px) {
    .checkout-main {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .customer-details {
        grid-template-columns: 1fr;
    }

    .security-badges {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .checkout-progress {
        gap: 1rem;
    }

    .security-badges {
        grid-template-columns: 1fr;
    }

    .lovemyfluffy-checkout-container {
        padding: 1rem 0;
    }

    .checkout-title {
        font-size: 2rem;
    }

    .checkout-form-section,
    .order-summary-card {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update progress steps based on form completion
    const billingFields = document.querySelectorAll('.billing-fields input[required]');
    const progressSteps = document.querySelectorAll('.progress-step');

    function updateProgress() {
        let completedFields = 0;
        billingFields.forEach(field => {
            if (field.value.trim() !== '') {
                completedFields++;
            }
        });

        const progressPercentage = (completedFields / billingFields.length) * 100;

        if (progressPercentage > 50) {
            progressSteps[1].classList.add('active');
        }

        if (progressPercentage === 100) {
            progressSteps[2].classList.add('active');
        }
    }

    billingFields.forEach(field => {
        field.addEventListener('input', updateProgress);
    });

    // Smooth scroll to payment section when billing is complete
    const paymentSection = document.querySelector('.payment-step');
    if (paymentSection) {
        billingFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    setTimeout(() => {
                        paymentSection.scrollIntoView({ behavior: 'smooth' });
                    }, 500);
                }
            });
        });
    }
});
</script>