<?php
/**
 * The template for displaying the footer
 *
 * @package LoveMyFluffy
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php _e('About LoveMyFluffy', 'lovemyfluffy'); ?></h3>
                    <p><?php _e('Your trusted partner in pet care, providing quality supplies for all your beloved companions. From dogs and cats to birds and fish, we have everything you need.', 'lovemyfluffy'); ?></p>
                </div>

                <div class="footer-section">
                    <h3><?php _e('Quick Links', 'lovemyfluffy'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>

                <div class="footer-section">
                    <h3><?php _e('Customer Service', 'lovemyfluffy'); ?></h3>
                    <ul>
                        <li><a href="/shipping-info"><?php _e('Shipping Information', 'lovemyfluffy'); ?></a></li>
                        <li><a href="/returns"><?php _e('Returns & Exchanges', 'lovemyfluffy'); ?></a></li>
                        <li><a href="/contact"><?php _e('Contact Us', 'lovemyfluffy'); ?></a></li>
                        <li><a href="/faq"><?php _e('FAQ', 'lovemyfluffy'); ?></a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3><?php _e('Connect With Us', 'lovemyfluffy'); ?></h3>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>

                    <?php if (is_active_sidebar('footer-widgets')) : ?>
                        <div class="footer-widgets">
                            <?php dynamic_sidebar('footer-widgets'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-info">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'lovemyfluffy'); ?></p>

                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="payment-security">
                            <span><?php _e('Secure payments powered by Stripe', 'lovemyfluffy'); ?></span>
                            <div class="payment-icons">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-amex"></i>
                                <i class="fab fa-cc-discover"></i>
                                <i class="fab fa-apple-pay"></i>
                                <i class="fab fa-google-pay"></i>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-legal">
                    <a href="/privacy-policy"><?php _e('Privacy Policy', 'lovemyfluffy'); ?></a> |
                    <a href="/terms-of-service"><?php _e('Terms of Service', 'lovemyfluffy'); ?></a>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>