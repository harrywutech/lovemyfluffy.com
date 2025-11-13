<?php
/**
 * The header for the LoveMyFluffy theme
 *
 * @package LoveMyFluffy
 */
?>
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
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>

                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>

                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) :
                ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => 'wp_page_menu',
                ));
                ?>

                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="header-cart">
                        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'lovemyfluffy'); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <?php if (is_front_page() && !is_home()) : ?>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2><?php _e('Premium Pet Supplies for Your Beloved Companions', 'lovemyfluffy'); ?></h2>
                    <p><?php _e('Quality products for dogs, cats, birds, fish, and small pets - everything your furry, feathered, and finned friends need.', 'lovemyfluffy'); ?></p>
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="cta-button">
                            <?php _e('Shop Now', 'lovemyfluffy'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="featured-categories">
            <div class="container">
                <h2><?php _e('Shop by Pet Type', 'lovemyfluffy'); ?></h2>
                <div class="pet-categories">
                    <div class="pet-category dogs">
                        <i class="fas fa-dog"></i>
                        <h3><?php _e('Dogs', 'lovemyfluffy'); ?></h3>
                        <p><?php _e('Food, toys, accessories, and health products for your canine companions.', 'lovemyfluffy'); ?></p>
                    </div>
                    <div class="pet-category cats">
                        <i class="fas fa-cat"></i>
                        <h3><?php _e('Cats', 'lovemyfluffy'); ?></h3>
                        <p><?php _e('Premium supplies for your feline friends, from food to litter and beyond.', 'lovemyfluffy'); ?></p>
                    </div>
                    <div class="pet-category birds">
                        <i class="fas fa-dove"></i>
                        <h3><?php _e('Birds', 'lovemyfluffy'); ?></h3>
                        <p><?php _e('Cages, food, toys, and health products for your feathered friends.', 'lovemyfluffy'); ?></p>
                    </div>
                    <div class="pet-category fish">
                        <i class="fas fa-fish"></i>
                        <h3><?php _e('Fish', 'lovemyfluffy'); ?></h3>
                        <p><?php _e('Aquarium supplies, food, and decorations for your aquatic pets.', 'lovemyfluffy'); ?></p>
                    </div>
                    <div class="pet-category small-pets">
                        <i class="fas fa-hamster"></i>
                        <h3><?php _e('Small Pets', 'lovemyfluffy'); ?></h3>
                        <p><?php _e('Habitats, food, and accessories for rabbits, hamsters, and other small pets.', 'lovemyfluffy'); ?></p>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>