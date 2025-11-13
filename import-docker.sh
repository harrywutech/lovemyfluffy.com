#!/bin/bash

# Import script for LoveMyFluffy Docker setup
# This script imports containers, volumes, database, and all project files

set -e  # Exit on error

# Configuration
IMPORT_DIR="."
TIMESTAMP=$(date +%Y%m%d-%H%M%S)

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${GREEN}=== LoveMyFluffy Docker Import ===${NC}"
echo ""

# Check if we're in the right directory
if [ ! -f "docker-compose.yml" ]; then
    echo -e "${RED}Error: docker-compose.yml not found.${NC}"
    echo "Please run this script from the project root directory."
    exit 1
fi

# Check if export directory exists
EXPORT_NAME=""
if [ -d "lovemyfluffy-export" ]; then
    # Find the most recent export
    EXPORT_NAME=$(ls -td lovemyfluffy-export/lovemyfluffy-export-* 2>/dev/null | head -1 | xargs basename)
    if [ -z "$EXPORT_NAME" ]; then
        echo -e "${YELLOW}No export directory found in lovemyfluffy-export/${NC}"
        echo "Please extract your export archive here first."
        exit 1
    fi
    EXPORT_PATH="lovemyfluffy-export/${EXPORT_NAME}"
elif [ -d "lovemyfluffy-export-*" ]; then
    EXPORT_NAME=$(ls -td lovemyfluffy-export-* 2>/dev/null | head -1)
    EXPORT_PATH="${EXPORT_NAME}"
else
    echo -e "${YELLOW}No export directory found.${NC}"
    echo "Please extract your export archive here first."
    echo "Expected: lovemyfluffy-export/lovemyfluffy-export-YYYYMMDD-HHMMSS/"
    exit 1
fi

if [ ! -d "$EXPORT_PATH" ]; then
    echo -e "${RED}Error: Export directory not found: ${EXPORT_PATH}${NC}"
    exit 1
fi

echo "Import source: ${EXPORT_PATH}"
echo ""

# Check for .env file
if [ ! -f ".env" ]; then
    if [ -f "${EXPORT_PATH}/.env.example" ]; then
        echo -e "${YELLOW}⚠ .env file not found.${NC}"
        echo "Creating .env from template..."
        cp "${EXPORT_PATH}/.env.example" .env
        echo -e "${BLUE}Please edit .env file with your configuration before continuing.${NC}"
        echo "Press Enter to continue after updating .env, or Ctrl+C to cancel..."
        read
    else
        echo -e "${RED}Error: .env file not found and no template available.${NC}"
        exit 1
    fi
fi

# Load environment variables
source .env

# Step 1: Stop existing containers (if any)
echo -e "${YELLOW}[1/7] Stopping existing containers...${NC}"
docker compose down 2>/dev/null || true
echo "  ✓ Containers stopped"

# Step 2: Load Docker images
echo -e "${YELLOW}[2/7] Loading Docker images...${NC}"
if [ -f "${EXPORT_PATH}/images/nginx-image.tar" ]; then
    echo "  - Loading nginx image..."
    docker load -i "${EXPORT_PATH}/images/nginx-image.tar"
    echo "  ✓ nginx image loaded"
fi

if [ -f "${EXPORT_PATH}/images/wordpress-image.tar" ]; then
    echo "  - Loading wordpress image..."
    docker load -i "${EXPORT_PATH}/images/wordpress-image.tar"
    echo "  ✓ wordpress image loaded"
fi

if [ -f "${EXPORT_PATH}/images/mysql-image.tar" ]; then
    echo "  - Loading mysql image..."
    docker load -i "${EXPORT_PATH}/images/mysql-image.tar"
    echo "  ✓ mysql image loaded"
else
    echo "  - Pulling mysql:8.0 image..."
    docker pull mysql:8.0
    echo "  ✓ mysql image ready"
fi

# Step 3: Create volumes
echo -e "${YELLOW}[3/7] Creating Docker volumes...${NC}"
docker volume create lovemyfluffycom_wordpress_data > /dev/null 2>&1 || echo "  - wordpress_data volume already exists"
docker volume create lovemyfluffycom_mysql_data > /dev/null 2>&1 || echo "  - mysql_data volume already exists"
echo "  ✓ Volumes created"

# Step 4: Import volumes
echo -e "${YELLOW}[4/7] Importing Docker volumes...${NC}"
if [ -f "${EXPORT_PATH}/volumes/wordpress_data.tar.gz" ]; then
    echo "  - Importing wordpress_data volume..."
    docker run --rm \
        -v lovemyfluffycom_wordpress_data:/target \
        -v "$(pwd)/${EXPORT_PATH}/volumes:/backup:ro" \
        alpine sh -c "rm -rf /target/* && tar xzf /backup/wordpress_data.tar.gz -C /target"
    echo "  ✓ wordpress_data imported"
else
    echo "  ⚠ wordpress_data backup not found, skipping"
fi

if [ -f "${EXPORT_PATH}/volumes/mysql_data.tar.gz" ]; then
    echo "  - Importing mysql_data volume..."
    docker run --rm \
        -v lovemyfluffycom_mysql_data:/target \
        -v "$(pwd)/${EXPORT_PATH}/volumes:/backup:ro" \
        alpine sh -c "rm -rf /target/* && tar xzf /backup/mysql_data.tar.gz -C /target"
    echo "  ✓ mysql_data imported"
else
    echo "  ⚠ mysql_data backup not found, skipping"
fi

# Step 5: Copy project files (if needed)
echo -e "${YELLOW}[5/7] Checking project files...${NC}"
if [ -d "${EXPORT_PATH}/project" ]; then
    echo "  - Project files found in export"
    echo "  ℹ Project files should already be in place"
    echo "  ✓ Project files ready"
else
    echo "  ⚠ Project files not found in export"
fi

# Step 6: Start containers
echo -e "${YELLOW}[6/7] Starting containers...${NC}"
docker compose up -d
echo "  ✓ Containers started"

# Wait for MySQL to be ready
echo "  - Waiting for MySQL to be ready..."
MAX_ATTEMPTS=30
ATTEMPT=0
while [ $ATTEMPT -lt $MAX_ATTEMPTS ]; do
    if docker compose exec -T mysql mysqladmin ping -h localhost --silent 2>/dev/null; then
        echo "  ✓ MySQL is ready"
        break
    fi
    ATTEMPT=$((ATTEMPT + 1))
    sleep 2
done

if [ $ATTEMPT -eq $MAX_ATTEMPTS ]; then
    echo -e "${RED}  ⚠ MySQL did not become ready in time${NC}"
fi

# Step 7: Import database
echo -e "${YELLOW}[7/7] Importing database...${NC}"
if [ -f "${EXPORT_PATH}/database/dump.sql" ]; then
    DB_NAME="${MYSQL_DATABASE:-lovemyfluffy}"
    DB_USER="${MYSQL_USER:-wordpress}"
    DB_PASS="${MYSQL_PASSWORD:-wordpress}"
    
    echo "  - Importing database dump..."
    
    # Wait a bit more for MySQL to fully initialize
    sleep 5
    
    # Create database if it doesn't exist
    docker compose exec -T mysql mysql -uroot -p"${MYSQL_ROOT_PASSWORD:-rootpassword}" -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};" 2>/dev/null || true
    
    # Import the dump
    docker compose exec -T mysql mysql \
        -u"${DB_USER}" \
        -p"${DB_PASS}" \
        "${DB_NAME}" < "${EXPORT_PATH}/database/dump.sql"
    
    echo "  ✓ Database imported"
elif [ -f "${EXPORT_PATH}/database/all_databases.sql" ]; then
    echo "  - Importing all databases dump..."
    docker compose exec -T mysql mysql \
        -uroot \
        -p"${MYSQL_ROOT_PASSWORD:-rootpassword}" < "${EXPORT_PATH}/database/all_databases.sql" 2>/dev/null || true
    echo "  ✓ All databases imported"
else
    echo "  ⚠ Database dump not found, skipping import"
    echo "  ℹ Database will be initialized from scratch if volumes were imported"
fi

# Final status check
echo ""
echo -e "${GREEN}=== Import Complete ===${NC}"
echo ""
echo "Checking container status..."
docker compose ps
echo ""
echo -e "${BLUE}Next steps:${NC}"
echo "1. Verify containers are running: docker compose ps"
echo "2. Check logs if needed: docker compose logs"
echo "3. Access the site at: http://localhost:${NGINX_PORT:-8660}"
echo ""
echo "If you encounter issues:"
echo "- Check logs: docker compose logs [service-name]"
echo "- Verify .env file has correct values"
echo "- Ensure ports are not in use: lsof -i :${NGINX_PORT:-8660}"

