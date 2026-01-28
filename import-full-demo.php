<?php
/**
 * Full Demo Import - Uses BZOTech's built-in importer
 */

define('WP_USE_THEMES', false);
require_once('/var/www/html/wp-load.php');

if (php_sapi_name() !== 'cli') {
    die('CLI only');
}

echo "🚀 Starting Full Demo Import (Demo 1)...\n\n";

// Load the importer
require_once('/var/www/html/wp-content/plugins/bzotech-core/libs/importer/importer.php');

$demo_path = '/var/www/html/wp-content/themes/bw-petito/data-import/demo1/data/';

// Files to import in order
$import_files = [
    'product.xml' => 'Products',
    'page.xml' => 'Pages',
    'post.xml' => 'Blog Posts',
    'header.xml' => 'Headers',
    'footer.xml' => 'Footers',
    'megapage.xml' => 'Mega Menu Pages',
];

foreach ($import_files as $file => $label) {
    $filepath = $demo_path . $file;

    if (!file_exists($filepath)) {
        echo "⚠️  Skipping $label - file not found\n";
        continue;
    }

    echo "📦 Importing $label from $file...\n";

    try {
        // Initialize importer
        if (!class_exists('WP_Import')) {
            require_once ABSPATH . 'wp-admin/includes/import.php';
            $importer_class = new WP_Import();
        } else {
            $importer_class = new WP_Import();
        }

        // Set options
        $importer_class->fetch_attachments = true;

        // Import
        ob_start();
        $importer_class->import($filepath);
        ob_end_clean();

        echo "✅ Imported $label\n\n";

    } catch (Exception $e) {
        echo "❌ Error importing $label: " . $e->getMessage() . "\n\n";
    }
}

// Set homepage
echo "🏠 Configuring homepage...\n";
$pages = get_pages();
if (!empty($pages)) {
    // Find Home page
    foreach ($pages as $page) {
        if (strtolower($page->post_title) === 'home' || strtolower($page->post_title) === 'homepage') {
            update_option('page_on_front', $page->ID);
            update_option('show_on_front', 'page');
            echo "✅ Set homepage to: {$page->post_title}\n";
            break;
        }
    }
}

// Set shop page
if (function_exists('wc_get_page_id')) {
    $shop_pages = get_pages(['s' => 'shop']);
    if (!empty($shop_pages)) {
        update_option('woocommerce_shop_page_id', $shop_pages[0]->ID);
        echo "✅ Set shop page\n";
    }
}

// Flush permalinks
flush_rewrite_rules();
echo "✅ Flushed permalinks\n";

echo "\n🎉 Demo import completed!\n";
echo "Visit: http://localhost:8660\n";
