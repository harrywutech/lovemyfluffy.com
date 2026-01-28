#!/bin/bash

# Deployment script for LoveMyFluffy WordPress/WooCommerce
# This script handles production deployments with safety checks and rollback capability

set -e  # Exit on error

# Configuration
PROJECT_DIR="${PROJECT_DIR:-$(pwd)}"
BACKUP_DIR="${PROJECT_DIR}/backups"
TIMESTAMP=$(date +%Y%m%d-%H%M%S)
SKIP_BACKUP="${SKIP_BACKUP:-false}"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Functions
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running in correct directory
check_directory() {
    if [ ! -f "docker-compose.yml" ]; then
        log_error "docker-compose.yml not found. Please run from project root."
        exit 1
    fi
    log_success "Running in correct directory"
}

# Load environment variables
load_env() {
    if [ ! -f ".env" ]; then
        log_error ".env file not found"
        exit 1
    fi
    source .env
    log_success "Environment variables loaded"
}

# Create backup directory
setup_backup_dir() {
    mkdir -p "${BACKUP_DIR}"
    log_info "Backup directory: ${BACKUP_DIR}"
}

# Backup database
backup_database() {
    if [ "${SKIP_BACKUP}" = "true" ]; then
        log_warning "Skipping database backup (manual override)"
        return 0
    fi

    log_info "Creating database backup..."
    BACKUP_FILE="${BACKUP_DIR}/db-backup-${TIMESTAMP}.sql"

    if docker compose ps mysql | grep -q "Up"; then
        docker compose exec -T mysql mysqldump \
            -u"${MYSQL_USER}" \
            -p"${MYSQL_PASSWORD}" \
            --single-transaction \
            --routines \
            --triggers \
            "${MYSQL_DATABASE}" > "${BACKUP_FILE}" 2>/dev/null

        if [ -f "${BACKUP_FILE}" ] && [ -s "${BACKUP_FILE}" ]; then
            log_success "Database backup created: ${BACKUP_FILE}"

            # Compress backup
            gzip "${BACKUP_FILE}"
            log_success "Backup compressed: ${BACKUP_FILE}.gz"
        else
            log_error "Database backup failed"
            exit 1
        fi
    else
        log_warning "MySQL container is not running, skipping backup"
    fi
}

# Pull latest code
pull_code() {
    log_info "Pulling latest code from Git..."

    # Stash any local changes
    if [ -n "$(git status --porcelain)" ]; then
        log_warning "Local changes detected, stashing..."
        git stash
    fi

    git fetch origin
    git reset --hard origin/main

    log_success "Code updated to latest version"
    git log -1 --oneline
}

# Build Docker images
build_images() {
    log_info "Building Docker images..."

    # Pull base images
    docker compose pull || log_warning "Failed to pull some images"

    # Build custom images
    docker compose build --no-cache

    log_success "Docker images built successfully"
}

# Deploy containers
deploy_containers() {
    log_info "Deploying containers..."

    # Start services with recreate
    docker compose up -d --force-recreate --remove-orphans

    log_success "Containers deployed"
}

# Wait for services
wait_for_services() {
    log_info "Waiting for services to be ready..."

    # Wait for MySQL
    local max_attempts=30
    local attempt=0

    while [ $attempt -lt $max_attempts ]; do
        if docker compose exec -T mysql mysqladmin ping -h localhost --silent 2>/dev/null; then
            log_success "MySQL is ready"
            break
        fi
        attempt=$((attempt + 1))
        sleep 2
    done

    if [ $attempt -eq $max_attempts ]; then
        log_error "MySQL did not become ready in time"
        return 1
    fi

    # Wait for WordPress
    sleep 5
    log_success "Services are ready"
}

# Run health checks
run_health_checks() {
    log_info "Running health checks..."

    if [ -x "${PROJECT_DIR}/scripts/health-check.sh" ]; then
        bash "${PROJECT_DIR}/scripts/health-check.sh"
    else
        log_warning "Health check script not found, skipping"
    fi
}

# Cleanup old images
cleanup() {
    log_info "Cleaning up old Docker images..."
    docker image prune -f
    log_success "Cleanup completed"
}

# Rollback function
rollback() {
    log_error "Deployment failed, initiating rollback..."

    # Stop new containers
    docker compose down

    # Restore from backup if available
    if [ -n "${BACKUP_FILE}" ] && [ -f "${BACKUP_FILE}.gz" ]; then
        log_info "Restoring database from backup..."
        gunzip -c "${BACKUP_FILE}.gz" | docker compose exec -T mysql mysql \
            -u"${MYSQL_USER}" \
            -p"${MYSQL_PASSWORD}" \
            "${MYSQL_DATABASE}"
        log_success "Database restored"
    fi

    # Start old containers
    docker compose up -d

    log_error "Rollback completed. Please investigate the issue."
    exit 1
}

# Main deployment flow
main() {
    echo ""
    echo "================================"
    echo "LoveMyFluffy Production Deployment"
    echo "Timestamp: ${TIMESTAMP}"
    echo "================================"
    echo ""

    # Trap errors for rollback
    trap rollback ERR

    check_directory
    load_env
    setup_backup_dir
    backup_database
    pull_code
    build_images
    deploy_containers
    wait_for_services
    run_health_checks
    cleanup

    echo ""
    echo "================================"
    echo -e "${GREEN}Deployment completed successfully!${NC}"
    echo "================================"
    echo ""

    # Display status
    docker compose ps
}

# Run main function
main "$@"
