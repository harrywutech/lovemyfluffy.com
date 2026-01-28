<?php
/**
 * Import Demo Content for Petito Theme
 * This script imports demo1 content including products, pages, posts, and media
 */

// Load WordPress
require_once('/var/www/html/wp-load.php');

// Check if we're running in CLI
if (php_sapi_name() !== 'cli') {
    die('This script must be run from command line');
}

echo "Starting Petito Demo Import...\n\n";

// Load importer
if (!class_exists('WP_Importer')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
}

require_once WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';

// Demo files to import in order
$demo_path = '/var/www/html/wp-content/themes/bw-petito/data-import/demo1/data/';
$files_to_import = [
    'product.xml',    // Import products first
    'page.xml',       // Then pages
    'post.xml',       // Then posts
    'header.xml',     // Headers
    'footer.xml',     // Footers
];

foreach ($files_to_import as $file) {
    $filepath = $demo_path . $file;

    if (!file_exists($filepath)) {
        echo "⚠️  Skipping $file - file not found\n";
        continue;
    }

    echo "📦 Importing $file...\n";

    // Create importer instance
    $wp_import = new WP_Import();
    $wp_import->fetch_attachments = true; // Download images

    ob_start();
    $wp_import->import($filepath);
    ob_end_clean();

    echo "✅ Completed $file\n\n";
}

echo "\n🎉 Demo import completed!\n";
echo "Visit your site at: http://localhost:8660\n";
