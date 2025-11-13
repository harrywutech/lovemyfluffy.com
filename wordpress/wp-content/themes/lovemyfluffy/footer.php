    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">

                <div class="footer-section">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="/contact">Contact Us</a></li>
                        <li><a href="/shipping-info">Shipping Information</a></li>
                        <li><a href="/returns">Returns & Exchanges</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/size-guide">Pet Size Guide</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Pet Care</h3>
                    <ul>
                        <li><a href="/dog-care">Dog Care Tips</a></li>
                        <li><a href="/cat-care">Cat Care Tips</a></li>
                        <li><a href="/bird-care">Bird Care Tips</a></li>
                        <li><a href="/fish-care">Fish Care Tips</a></li>
                        <li><a href="/nutrition">Pet Nutrition Guide</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo function_exists('wc_get_page_id') ? get_permalink(wc_get_page_id('shop')) : '/shop'; ?>">Shop All Products</a></li>
                        <li><a href="/new-arrivals">New Arrivals</a></li>
                        <li><a href="/sale">Sale Items</a></li>
                        <li><a href="/brands">Featured Brands</a></li>
                        <li><a href="/gift-cards">Gift Cards</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Connect With Us</h3>
                    <div class="contact-info">
                        <p>📧 hello@lovemyfluffy.com</p>
                        <p>📞 1-800-PET-LOVE</p>
                        <p>🕒 Mon-Fri: 9AM-6PM EST</p>
                    </div>

                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">Twitter</a>
                        <a href="#" class="social-link">Pinterest</a>
                    </div>

                    <div class="payment-security">
                        <h4>Secure Payments</h4>
                        <div class="security-badges">
                            <span class="badge ssl">🔒 SSL Secured</span>
                            <span class="badge payment">💳 Stripe Payments</span>
                            <span class="badge guarantee">✅ 100% Satisfaction</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                <div class="footer-info">
                    <p>&copy; <?php echo date('Y'); ?> LoveMyFluffy.com - Premium Pet Supplies</p>
                    <p>Made with ❤️ for pet lovers everywhere</p>
                </div>

                <div class="footer-legal">
                    <a href="/privacy-policy">Privacy Policy</a>
                    <span class="separator">|</span>
                    <a href="/terms-of-service">Terms of Service</a>
                    <span class="separator">|</span>
                    <a href="/accessibility">Accessibility</a>
                </div>
            </div>

            <div class="footer-widgets">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>