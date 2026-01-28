<?php
/**
 * Quick Demo Import Script
 * Imports essential demo content without images for faster processing
 */

require_once('/var/www/html/wp-load.php');

if (php_sapi_name() !== 'cli') {
    die('CLI only');
}

echo "🚀 Starting Quick Demo Import (products + pages only)...\n\n";

// Install WordPress Importer if not already
if (!class_exists('WP_Importer')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
}

if (!class_exists('WP_Import')) {
    require_once WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
}

$demo_path = '/var/www/html/wp-content/themes/bw-petito/data-import/demo1/data/';

// Import only essential content (skip media for speed)
$files = ['product.xml', 'page.xml'];

foreach ($files as $file) {
    $filepath = $demo_path . $file;

    if (!file_exists($filepath)) {
        echo "⚠️  File not found: $file\n";
        continue;
    }

    echo "📦 Importing $file...\n";

    try {
        $wp_import = new WP_Import();
        $wp_import->fetch_attachments = false; // Skip images for speed

        // Suppress output
        ob_start();
        $wp_import->import($filepath);
        $output = ob_get_clean();

        echo "✅ Imported $file\n";
    } catch (Exception $e) {
        echo "❌ Error importing $file: " . $e->getMessage() . "\n";
    }
}

// Set a sample homepage
$pages = get_pages();
if (!empty($pages)) {
    update_option('page_on_front', $pages[0]->ID);
    update_option('show_on_front', 'page');
    echo "\n✅ Set homepage\n";
}

echo "\n🎉 Demo import completed!\n";
echo "Visit: http://localhost:8660\n";
