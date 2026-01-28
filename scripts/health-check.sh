#!/bin/bash

# Health check script for LoveMyFluffy deployment
# Verifies all services are running and responding correctly

set -e

# Configuration
NGINX_PORT="${NGINX_PORT:-8660}"
MAX_RETRIES=5
RETRY_DELAY=3

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Exit codes
EXIT_SUCCESS=0
EXIT_FAILURE=1

# Check result tracking
CHECKS_PASSED=0
CHECKS_FAILED=0

# Functions
log_check() {
    echo -e "${YELLOW}[CHECK]${NC} $1"
}

log_pass() {
    echo -e "${GREEN}[PASS]${NC} $1"
    CHECKS_PASSED=$((CHECKS_PASSED + 1))
}

log_fail() {
    echo -e "${RED}[FAIL]${NC} $1"
    CHECKS_FAILED=$((CHECKS_FAILED + 1))
}

# Check if Docker containers are running
check_containers() {
    log_check "Checking Docker containers status..."

    local containers=("lovemyfluffy_nginx" "lovemyfluffy_wordpress" "lovemyfluffy_mysql")

    for container in "${containers[@]}"; do
        if docker ps --filter "name=${container}" --filter "status=running" | grep -q "${container}"; then
            log_pass "Container ${container} is running"
        else
            log_fail "Container ${container} is not running"
        fi
    done
}

# Check MySQL connectivity
check_mysql() {
    log_check "Checking MySQL connectivity..."

    if docker compose exec -T mysql mysqladmin ping -h localhost --silent 2>/dev/null; then
        log_pass "MySQL is responding"

        # Check database exists
        if docker compose exec -T mysql mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "USE ${MYSQL_DATABASE}" 2>/dev/null; then
            log_pass "Database ${MYSQL_DATABASE} exists"
        else
            log_fail "Database ${MYSQL_DATABASE} not found"
        fi
    else
        log_fail "MySQL is not responding"
    fi
}

# Check WordPress accessibility
check_wordpress() {
    log_check "Checking WordPress accessibility..."

    local retry=0
    local success=false

    while [ $retry -lt $MAX_RETRIES ]; do
        if curl -f -s -o /dev/null http://localhost:${NGINX_PORT}; then
            success=true
            break
        fi
        retry=$((retry + 1))
        sleep $RETRY_DELAY
    done

    if [ "$success" = true ]; then
        log_pass "WordPress is accessible at http://localhost:${NGINX_PORT}"
    else
        log_fail "WordPress is not accessible"
    fi
}

# Check nginx configuration
check_nginx() {
    log_check "Checking nginx configuration..."

    if docker compose exec -T nginx nginx -t 2>&1 | grep -q "successful"; then
        log_pass "Nginx configuration is valid"
    else
        log_fail "Nginx configuration has errors"
    fi
}

# Check for critical errors in logs
check_logs() {
    log_check "Checking for critical errors in logs..."

    local has_errors=false

    # Check nginx logs
    if docker compose logs --tail=50 nginx 2>&1 | grep -i "emerg\|alert\|crit" >/dev/null; then
        log_fail "Critical errors found in nginx logs"
        has_errors=true
    fi

    # Check WordPress logs
    if docker compose logs --tail=50 wordpress 2>&1 | grep -i "fatal error" >/dev/null; then
        log_fail "Fatal errors found in WordPress logs"
        has_errors=true
    fi

    # Check MySQL logs
    if docker compose logs --tail=50 mysql 2>&1 | grep -i "\[ERROR\]" >/dev/null; then
        log_fail "Errors found in MySQL logs"
        has_errors=true
    fi

    if [ "$has_errors" = false ]; then
        log_pass "No critical errors in logs"
    fi
}

# Check disk space
check_disk_space() {
    log_check "Checking disk space..."

    local disk_usage=$(df -h . | awk 'NR==2 {print $5}' | sed 's/%//')

    if [ "$disk_usage" -lt 80 ]; then
        log_pass "Disk space is adequate (${disk_usage}% used)"
    elif [ "$disk_usage" -lt 90 ]; then
        log_fail "Disk space is getting low (${disk_usage}% used)"
    else
        log_fail "Disk space is critically low (${disk_usage}% used)"
    fi
}

# Check Docker volumes
check_volumes() {
    log_check "Checking Docker volumes..."

    local volumes=("lovemyfluffycom_wordpress_data" "lovemyfluffycom_mysql_data")

    for volume in "${volumes[@]}"; do
        if docker volume inspect "$volume" >/dev/null 2>&1; then
            log_pass "Volume ${volume} exists"
        else
            log_fail "Volume ${volume} not found"
        fi
    done
}

# Check WordPress core files
check_wordpress_files() {
    log_check "Checking WordPress core files..."

    if docker compose exec -T wordpress test -f /var/www/html/wp-config.php; then
        log_pass "wp-config.php exists"
    else
        log_fail "wp-config.php not found"
    fi

    if docker compose exec -T wordpress test -d /var/www/html/wp-content; then
        log_pass "wp-content directory exists"
    else
        log_fail "wp-content directory not found"
    fi
}

# Check PHP version
check_php() {
    log_check "Checking PHP version..."

    php_version=$(docker compose exec -T wordpress php -v | head -n 1 | awk '{print $2}')

    if [ -n "$php_version" ]; then
        log_pass "PHP version: ${php_version}"
    else
        log_fail "Unable to determine PHP version"
    fi
}

# Main health check
main() {
    echo ""
    echo "================================"
    echo "Health Check - LoveMyFluffy"
    echo "================================"
    echo ""

    # Load environment if available
    if [ -f ".env" ]; then
        source .env
    fi

    # Run all checks
    check_containers
    check_mysql
    check_wordpress
    check_nginx
    check_volumes
    check_wordpress_files
    check_php
    check_disk_space
    check_logs

    # Summary
    echo ""
    echo "================================"
    echo "Health Check Summary"
    echo "================================"
    echo -e "Passed: ${GREEN}${CHECKS_PASSED}${NC}"
    echo -e "Failed: ${RED}${CHECKS_FAILED}${NC}"
    echo ""

    if [ $CHECKS_FAILED -eq 0 ]; then
        echo -e "${GREEN}All health checks passed!${NC}"
        exit $EXIT_SUCCESS
    else
        echo -e "${RED}Some health checks failed!${NC}"
        exit $EXIT_FAILURE
    fi
}

# Run main function
main "$@"
