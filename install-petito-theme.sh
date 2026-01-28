#!/bin/bash
# Petito Theme Installation Script for LoveMyFluffy.com
# This script automates the installation of Petito theme and required plugins
#
# Usage: bash install-petito-theme.sh

set -e  # Exit on error

echo "========================================="
echo "Petito Theme Installation Script"
echo "========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Check if Docker is running
if ! docker ps > /dev/null 2>&1; then
    echo -e "${RED}Error: Docker is not running. Please start Docker first.${NC}"
    exit 1
fi

# Check if WordPress container is running
if ! docker ps | grep -q lovemyfluffy_wordpress; then
    echo -e "${YELLOW}WordPress container is not running. Starting services...${NC}"
    docker compose -f docker-compose-production.yml up -d
    echo "Waiting for WordPress to be ready (30 seconds)..."
    sleep 30
fi

echo -e "${GREEN}✓ Docker environment is ready${NC}"
echo ""

# Define paths
THEME_FILES_DIR="./wordpress/theme-files"
THEMES_DIR="./wordpress/wp-content/themes"
PLUGINS_DIR="./wordpress/wp-content/plugins"

# Create directories if they don't exist
mkdir -p "$THEMES_DIR"
mkdir -p "$PLUGINS_DIR"

echo "Step 1: Installing Petito Theme"
echo "--------------------------------"

# Check if theme files exist
if [ ! -f "$THEME_FILES_DIR/Theme/bw-petito.v1.6.5.zip" ]; then
    echo -e "${RED}Error: Theme file not found at $THEME_FILES_DIR/Theme/bw-petito.v1.6.5.zip${NC}"
    exit 1
fi

# Install main theme
echo "Installing main theme (bw-petito)..."
docker exec lovemyfluffy_wordpress wp theme install /var/www/html/wp-content/theme-files/Theme/bw-petito.v1.6.5.zip --allow-root

# Install child theme
echo "Installing child theme (bw-petito-child)..."
docker exec lovemyfluffy_wordpress wp theme install /var/www/html/wp-content/theme-files/Theme/bw-petito-child.zip --allow-root

# Activate child theme
echo "Activating child theme..."
docker exec lovemyfluffy_wordpress wp theme activate bw-petito-child --allow-root

echo -e "${GREEN}✓ Petito theme installed and activated${NC}"
echo ""

echo "Step 2: Installing Required Plugins"
echo "------------------------------------"

# Install WooCommerce
echo "Installing WooCommerce..."
docker exec lovemyfluffy_wordpress wp plugin install woocommerce --activate --allow-root

# Install Elementor
echo "Installing Elementor..."
docker exec lovemyfluffy_wordpress wp plugin install elementor --activate --allow-root

# Install Revolution Slider
echo "Installing Revolution Slider..."
if [ -f "$THEME_FILES_DIR/Bundled Plugins/revslider.zip" ]; then
    docker exec lovemyfluffy_wordpress wp plugin install /var/www/html/wp-content/theme-files/Bundled\ Plugins/revslider.zip --activate --allow-root
else
    echo -e "${YELLOW}Warning: Revolution Slider not found. Please install manually.${NC}"
fi

# Install other common plugins
echo "Installing additional plugins..."
docker exec lovemyfluffy_wordpress wp plugin install contact-form-7 --activate --allow-root
docker exec lovemyfluffy_wordpress wp plugin install wordpress-seo --activate --allow-root

echo -e "${GREEN}✓ Required plugins installed${NC}"
echo ""

echo "Step 3: Configuring WordPress Settings"
echo "---------------------------------------"

# Set permalink structure
echo "Setting permalink structure..."
docker exec lovemyfluffy_wordpress wp rewrite structure '/%postname%/' --allow-root

# Create WooCommerce pages
echo "Creating WooCommerce pages..."
docker exec lovemyfluffy_wordpress wp wc tool run install_pages --user=admin --allow-root 2>/dev/null || echo "WooCommerce pages may already exist"

echo -e "${GREEN}✓ WordPress settings configured${NC}"
echo ""

echo "========================================="
echo -e "${GREEN}Installation Complete!${NC}"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Access WordPress admin: http://localhost:8660/wp-admin"
echo "2. Go to Theme Options > Import Demo Content"
echo "3. Select Demo 4 and click 'Import Now'"
echo "4. Wait for the import to complete (may take 10-15 minutes)"
echo ""
echo "For detailed instructions, see: PETITO-THEME-SETUP.md"
echo ""
