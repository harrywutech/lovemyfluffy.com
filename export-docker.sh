#!/bin/bash

# Export script for LoveMyFluffy Docker setup
# This script exports containers, volumes, database, and all project files

set -e  # Exit on error

# Configuration
EXPORT_DIR="lovemyfluffy-export"
TIMESTAMP=$(date +%Y%m%d-%H%M%S)
EXPORT_NAME="lovemyfluffy-export-${TIMESTAMP}"
BACKUP_DIR="${EXPORT_DIR}/${EXPORT_NAME}"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}=== LoveMyFluffy Docker Export ===${NC}"
echo "Export directory: ${BACKUP_DIR}"
echo ""

# Create export directory
mkdir -p "${BACKUP_DIR}"
mkdir -p "${BACKUP_DIR}/volumes"
mkdir -p "${BACKUP_DIR}/database"
mkdir -p "${BACKUP_DIR}/images"
mkdir -p "${BACKUP_DIR}/project"

# Step 1: Export Docker volumes
echo -e "${YELLOW}[1/6] Exporting Docker volumes...${NC}"
docker compose ps > /dev/null 2>&1 || echo "Warning: Some containers may not be running"

# Export wordpress_data volume
if docker volume inspect lovemyfluffycom_wordpress_data > /dev/null 2>&1; then
    echo "  - Exporting wordpress_data volume..."
    docker run --rm \
        -v lovemyfluffycom_wordpress_data:/source:ro \
        -v "$(pwd)/${BACKUP_DIR}/volumes:/backup" \
        alpine tar czf /backup/wordpress_data.tar.gz -C /source .
    echo "  ✓ wordpress_data exported"
else
    echo "  ⚠ wordpress_data volume not found"
fi

# Export mysql_data volume
if docker volume inspect lovemyfluffycom_mysql_data > /dev/null 2>&1; then
    echo "  - Exporting mysql_data volume..."
    docker run --rm \
        -v lovemyfluffycom_mysql_data:/source:ro \
        -v "$(pwd)/${BACKUP_DIR}/volumes:/backup" \
        alpine tar czf /backup/mysql_data.tar.gz -C /source .
    echo "  ✓ mysql_data exported"
else
    echo "  ⚠ mysql_data volume not found"
fi

# Step 2: Export database dump
echo -e "${YELLOW}[2/6] Exporting database...${NC}"
if docker compose ps mysql | grep -q "Up"; then
    # Load environment variables
    if [ -f .env ]; then
        source .env
    fi
    
    DB_NAME="${MYSQL_DATABASE:-lovemyfluffy}"
    DB_USER="${MYSQL_USER:-wordpress}"
    DB_PASS="${MYSQL_PASSWORD:-wordpress}"
    
    echo "  - Creating MySQL dump..."
    docker compose exec -T mysql mysqldump \
        -u"${DB_USER}" \
        -p"${DB_PASS}" \
        --single-transaction \
        --routines \
        --triggers \
        "${DB_NAME}" > "${BACKUP_DIR}/database/dump.sql"
    
    # Also export all databases (for completeness)
    docker compose exec -T mysql mysqldump \
        -uroot \
        -p"${MYSQL_ROOT_PASSWORD:-rootpassword}" \
        --all-databases \
        --single-transaction \
        --routines \
        --triggers > "${BACKUP_DIR}/database/all_databases.sql" 2>/dev/null || true
    
    echo "  ✓ Database exported"
else
    echo "  ⚠ MySQL container is not running, skipping database export"
fi

# Step 3: Save Docker images
echo -e "${YELLOW}[3/6] Saving Docker images...${NC}"
echo "  - Saving nginx image..."
docker image save lovemyfluffycom-nginx:latest -o "${BACKUP_DIR}/images/nginx-image.tar" 2>/dev/null || echo "  ⚠ nginx image not found"

echo "  - Saving wordpress image..."
docker image save lovemyfluffycom-wordpress:latest -o "${BACKUP_DIR}/images/wordpress-image.tar" 2>/dev/null || echo "  ⚠ wordpress image not found"

echo "  - Saving mysql image..."
docker image save mysql:8.0 -o "${BACKUP_DIR}/images/mysql-image.tar" 2>/dev/null || echo "  ⚠ mysql image not found"

echo "  ✓ Images saved"

# Step 4: Copy project files (excluding unnecessary files)
echo -e "${YELLOW}[4/6] Copying project files...${NC}"
rsync -av --progress \
    --exclude='.git' \
    --exclude='node_modules' \
    --exclude='.playwright-mcp' \
    --exclude='wordpress/wp-content/uploads' \
    --exclude='wordpress/wp-content/cache' \
    --exclude='wordpress/wp-content/upgrade' \
    --exclude='wordpress/wp-content/backup-db' \
    --exclude='wordpress/wp-content/debug.log' \
    --exclude='*.log' \
    --exclude='.env' \
    --exclude='${EXPORT_DIR}' \
    --exclude='*.tar.gz' \
    . "${BACKUP_DIR}/project/"

echo "  ✓ Project files copied"

# Step 5: Create environment template
echo -e "${YELLOW}[5/6] Creating environment template...${NC}"
if [ -f .env ]; then
    # Create .env.example with sanitized values
    sed 's/=.*/=CHANGE_ME/' .env > "${BACKUP_DIR}/.env.example"
    echo "  ✓ Environment template created"
else
    echo "  ⚠ .env file not found, creating template..."
    cat > "${BACKUP_DIR}/.env.example" << 'EOF'
# Database Configuration
MYSQL_ROOT_PASSWORD=CHANGE_ME
MYSQL_DATABASE=lovemyfluffy
MYSQL_USER=wordpress
MYSQL_PASSWORD=CHANGE_ME

# WordPress Configuration
WORDPRESS_DB_HOST=mysql
WORDPRESS_DB_NAME=lovemyfluffy
WORDPRESS_DB_USER=wordpress
WORDPRESS_DB_PASSWORD=CHANGE_ME
WORDPRESS_HOME=http://localhost:8660
WORDPRESS_SITEURL=http://localhost:8660
WORDPRESS_DEBUG=false
WORDPRESS_DEBUG_LOG=false
WORDPRESS_DEBUG_DISPLAY=false

# WordPress Security Keys (generate new ones at https://api.wordpress.org/secret-key/1.1/salt/)
WORDPRESS_AUTH_KEY=CHANGE_ME
WORDPRESS_SECURE_AUTH_KEY=CHANGE_ME
WORDPRESS_LOGGED_IN_KEY=CHANGE_ME
WORDPRESS_NONCE_KEY=CHANGE_ME
WORDPRESS_AUTH_SALT=CHANGE_ME
WORDPRESS_SECURE_AUTH_SALT=CHANGE_ME
WORDPRESS_LOGGED_IN_SALT=CHANGE_ME
WORDPRESS_NONCE_SALT=CHANGE_ME

# Nginx Configuration
NGINX_PORT=8660
EOF
fi

# Step 6: Create manifest and archive
echo -e "${YELLOW}[6/6] Creating manifest and archive...${NC}"

# Create manifest
cat > "${BACKUP_DIR}/MANIFEST.txt" << EOF
LoveMyFluffy Docker Export
==========================
Export Date: $(date)
Export Timestamp: ${TIMESTAMP}
Docker Compose Version: $(docker compose version 2>/dev/null || docker-compose version 2>/dev/null || echo "unknown")

Volumes:
- wordpress_data: $(docker volume inspect lovemyfluffycom_wordpress_data --format '{{.Mountpoint}}' 2>/dev/null || echo "not found")
- mysql_data: $(docker volume inspect lovemyfluffycom_mysql_data --format '{{.Mountpoint}}' 2>/dev/null || echo "not found")

Database:
- Database Name: ${DB_NAME:-lovemyfluffy}
- Dump File: database/dump.sql

Images:
- nginx: lovemyfluffycom-nginx:latest
- wordpress: lovemyfluffycom-wordpress:latest
- mysql: mysql:8.0

Project Structure:
- docker-compose.yml
- nginx/
- wordpress/
- database/

Import Instructions:
1. Extract this archive on the target machine
2. Copy .env.example to .env and update with your values
3. Run: ./import-docker.sh
EOF

# Create compressed archive
echo "  - Creating compressed archive..."
cd "${EXPORT_DIR}"
tar czf "${EXPORT_NAME}.tar.gz" "${EXPORT_NAME}/"
cd ..

ARCHIVE_SIZE=$(du -h "${EXPORT_DIR}/${EXPORT_NAME}.tar.gz" | cut -f1)
echo "  ✓ Archive created: ${EXPORT_DIR}/${EXPORT_NAME}.tar.gz (${ARCHIVE_SIZE})"

# Summary
echo ""
echo -e "${GREEN}=== Export Complete ===${NC}"
echo "Export location: ${BACKUP_DIR}/${EXPORT_NAME}"
echo "Archive: ${EXPORT_DIR}/${EXPORT_NAME}.tar.gz"
echo "Size: ${ARCHIVE_SIZE}"
echo ""
echo "To transfer to another machine:"
echo "  scp ${EXPORT_DIR}/${EXPORT_NAME}.tar.gz user@target-machine:/path/to/destination/"
echo ""
echo "Or use the extracted directory:"
echo "  rsync -av ${BACKUP_DIR}/${EXPORT_NAME}/ user@target-machine:/path/to/destination/"

