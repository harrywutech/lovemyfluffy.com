<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                        <span class="loading-paw">🐾</span>
                    </a>
                </h1>

                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) :
                ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>

            <div class="header-actions">
                <?php if (class_exists('WooCommerce') && function_exists('wc_get_cart_url')) : ?>
                    <div class="header-cart">
                        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                            <span class="cart-icon">🛒</span>
                            <span class="cart-count"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="user-account">
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                            My Account
                        </a>
                    <?php else : ?>
                        <a href="<?php echo wp_login_url(); ?>">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <nav id="site-navigation" class="main-navigation">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'lovemyfluffy_fallback_menu',
            ));
            ?>
        </div>
    </nav>

    <div id="content" class="site-content">