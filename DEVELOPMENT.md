# Development Environment Setup - LoveMyFluffy.com

Guide for setting up and using your local development environment on this Mac.

## Overview

This Mac is configured as your **development environment** where you'll:
- Develop features locally using Docker
- Test changes before pushing
- Commit and push to GitHub
- Trigger automated deployments to production

## Prerequisites

✅ Already installed on this Mac:
- Docker Desktop
- Git
- Project cloned to `/Users/MAC/Sites/lovemyfluffy.com`

## Development Environment

### Current Configuration

Your `.env` file is configured for **local development**:

```bash
# Local WordPress access
WORDPRESS_HOME=http://localhost:8660
WORDPRESS_SITEURL=http://localhost:8660

# Development mode enabled
WORDPRESS_DEBUG=true
WORDPRESS_DEBUG_LOG=true
WORDPRESS_DEBUG_DISPLAY=false

# Local ports
NGINX_PORT=8660
MYSQL_PORT=3306

# Stripe Test Mode
STRIPE_PUBLISHABLE_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
```

### Starting Development Environment

```bash
# Navigate to project
cd /Users/MAC/Sites/lovemyfluffy.com

# Start all services
docker compose up -d

# View logs
docker compose logs -f

# Stop services
docker compose down
```

Access your local site at: **http://localhost:8660**

### Development Workflow

1. **Start Docker services**:
   ```bash
   docker compose up -d
   ```

2. **Make code changes**:
   - Edit WordPress files in `wordpress/` directory
   - Modify theme/plugin files
   - Update configuration

3. **Test locally**:
   - Browse to http://localhost:8660
   - Test functionality
   - Check logs: `docker compose logs`

4. **Run health checks**:
   ```bash
   bash scripts/health-check.sh
   ```

5. **Commit changes**:
   ```bash
   git add .
   git commit -m "Your commit message"
   git push origin main
   ```

6. **Automated deployment**:
   - GitHub Actions automatically deploys to production
   - Monitor deployment in GitHub Actions tab

### Quick Commands

```bash
# Start services
docker compose up -d

# Stop services
docker compose down

# Restart services
docker compose restart

# View logs (all services)
docker compose logs -f

# View logs (specific service)
docker compose logs -f wordpress
docker compose logs -f nginx
docker compose logs -f mysql

# Access WordPress container
docker compose exec wordpress bash

# Access MySQL container
docker compose exec mysql bash

# Run MySQL query
docker compose exec mysql mysql -uwordpress -pwordpress_secure_password_2025 lovemyfluffy

# Health check
bash scripts/health-check.sh

# Rebuild containers (after Dockerfile changes)
docker compose build
docker compose up -d
```

## File Structure

```
lovemyfluffy.com/
├── .github/
│   └── workflows/
│       ├── ci.yml           # CI testing
│       └── deploy.yml       # Production deployment
├── wordpress/               # WordPress files
│   ├── wp-content/         # Themes, plugins, uploads
│   └── wp-config.php       # WordPress config
├── nginx/
│   └── conf.d/             # Nginx configuration
├── database/
│   └── init/               # Database init scripts
├── scripts/
│   ├── deploy.sh           # Production deployment script
│   └── health-check.sh     # Health check script
├── docker-compose.yml      # Docker services configuration
├── .env                    # Development environment variables
├── DEVELOPMENT.md          # This file
└── DEPLOYMENT.md           # Production deployment guide
```

## Database Management

### Access MySQL

```bash
# Via Docker exec
docker compose exec mysql mysql -uwordpress -pwordpress_secure_password_2025 lovemyfluffy

# Via MySQL client (if installed)
mysql -h 127.0.0.1 -P 3306 -uwordpress -pwordpress_secure_password_2025 lovemyfluffy
```

### Backup Database

```bash
# Create backup
docker compose exec mysql mysqldump \
  -uwordpress -pwordpress_secure_password_2025 \
  lovemyfluffy > backups/dev-backup-$(date +%Y%m%d).sql

# Restore backup
docker compose exec -T mysql mysql \
  -uwordpress -pwordpress_secure_password_2025 \
  lovemyfluffy < backups/dev-backup-20251120.sql
```

### Reset Database

```bash
# Stop services
docker compose down

# Remove MySQL volume
docker volume rm lovemyfluffycom_mysql_data

# Restart (creates fresh database)
docker compose up -d
```

## WordPress Development

### Install WordPress

If WordPress isn't installed yet:

1. Go to http://localhost:8660
2. Follow WordPress installation wizard
3. Or import from production backup

### WP-CLI Commands

```bash
# Access WP-CLI
docker compose exec wordpress wp --allow-root

# Examples:
# List plugins
docker compose exec wordpress wp plugin list --allow-root

# Activate plugin
docker compose exec wordpress wp plugin activate woocommerce --allow-root

# Update WordPress core
docker compose exec wordpress wp core update --allow-root

# Create user
docker compose exec wordpress wp user create newuser user@example.com --role=administrator --allow-root
```

### Install Plugins/Themes

**Via WP Admin** (recommended):
- Go to http://localhost:8660/wp-admin
- Plugins → Add New
- Themes → Add New

**Via WP-CLI**:
```bash
# Install plugin
docker compose exec wordpress wp plugin install woocommerce --activate --allow-root

# Install theme
docker compose exec wordpress wp theme install storefront --activate --allow-root
```

**Manually**:
- Copy to `wordpress/wp-content/plugins/` or `wordpress/wp-content/themes/`

## Debugging

### Enable Debug Mode

Already enabled in your `.env`:
```bash
WORDPRESS_DEBUG=true
WORDPRESS_DEBUG_LOG=true
WORDPRESS_DEBUG_DISPLAY=false
```

### View Debug Log

```bash
# Watch debug log in real-time
tail -f wordpress/wp-content/debug.log

# View last 50 lines
tail -50 wordpress/wp-content/debug.log
```

### Check Container Logs

```bash
# All services
docker compose logs -f

# WordPress PHP errors
docker compose logs -f wordpress | grep -i error

# Nginx access log
docker compose logs -f nginx | grep -i GET

# MySQL errors
docker compose logs -f mysql | grep -i error
```

### Common Issues

| Issue | Solution |
|-------|----------|
| Port 8660 already in use | Change `NGINX_PORT` in `.env` and restart |
| Database connection error | Check MySQL container: `docker compose ps mysql` |
| Permission denied | Fix ownership: `chmod -R 755 wordpress/wp-content` |
| Can't write to uploads | `chmod 775 wordpress/wp-content/uploads` |
| White screen of death | Check `wordpress/wp-content/debug.log` |

## Testing Before Deployment

### Pre-Push Checklist

Before pushing to GitHub:

- [ ] Run health checks: `bash scripts/health-check.sh`
- [ ] Test all modified features locally
- [ ] Check debug log for errors
- [ ] Verify database changes (if any)
- [ ] Review git diff: `git diff`
- [ ] Ensure no sensitive data in commits

### Test CI Locally (Optional)

You can test the CI build locally:

```bash
# Stop current services
docker compose down

# Use CI environment variables
cat > .env.test << 'EOF'
MYSQL_ROOT_PASSWORD=test_root_password
MYSQL_DATABASE=lovemyfluffy_test
MYSQL_USER=wordpress_test
MYSQL_PASSWORD=test_password
WORDPRESS_DB_HOST=mysql
WORDPRESS_DB_NAME=lovemyfluffy_test
WORDPRESS_DB_USER=wordpress_test
WORDPRESS_DB_PASSWORD=test_password
WORDPRESS_HOME=http://localhost:8660
WORDPRESS_SITEURL=http://localhost:8660
WORDPRESS_DEBUG=true
NGINX_PORT=8660
EOF

# Build fresh
docker compose --env-file .env.test build

# Test startup
docker compose --env-file .env.test up -d

# Run health checks
bash scripts/health-check.sh

# Cleanup
docker compose down
rm .env.test
```

## Git Workflow

### Development Flow

```bash
# 1. Create feature branch (optional)
git checkout -b feature/my-new-feature

# 2. Make changes and test locally
# ... edit files ...
docker compose restart

# 3. Commit changes
git add .
git commit -m "Add: new feature description"

# 4. Push to GitHub
git push origin feature/my-new-feature

# 5. Create Pull Request (optional)
# Or merge to main:
git checkout main
git merge feature/my-new-feature
git push origin main
```

### Commit Message Guidelines

Use clear, descriptive commit messages:

```bash
# Good examples:
git commit -m "Add: product filtering by category"
git commit -m "Fix: checkout payment validation error"
git commit -m "Update: WooCommerce to version 8.0"
git commit -m "Remove: deprecated Stripe API calls"

# Use prefixes:
# Add: new features
# Fix: bug fixes
# Update: updates to existing features
# Remove: removed features
# Refactor: code refactoring
# Docs: documentation changes
```

## Production vs Development

### Key Differences

| Aspect | Development (This Mac) | Production (Other Mac) |
|--------|----------------------|----------------------|
| **URL** | http://localhost:8660 | http://your-domain.com |
| **Debug Mode** | Enabled | Disabled |
| **Stripe** | Test keys | Live keys |
| **Database** | Test data | Real customers |
| **Backups** | Manual/optional | Automatic before deploy |
| **Access** | Direct file editing | Via Git deployment only |

### Environment Variables

**Development (.env)**:
```bash
WORDPRESS_DEBUG=true              # Show errors
WORDPRESS_HOME=http://localhost:8660
STRIPE_SECRET_KEY=sk_test_...     # Test mode
```

**Production (.env on production Mac)**:
```bash
WORDPRESS_DEBUG=false             # Hide errors
WORDPRESS_HOME=https://lovemyfluffy.com
STRIPE_SECRET_KEY=sk_live_...     # Live mode
```

### Never on Production

❌ Don't do these on production Mac:
- Direct file editing
- Manual database changes
- Testing experimental features
- Using debug mode
- Test Stripe keys

✅ Always on development Mac:
- Develop features
- Test thoroughly
- Commit to Git
- Push to trigger deployment

## Stripe Integration (Development)

### Test Mode Setup

Your `.env` has Stripe test keys:

```bash
STRIPE_PUBLISHABLE_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

### Get Test Keys

1. Go to [Stripe Dashboard](https://dashboard.stripe.com/test/apikeys)
2. Copy "Publishable key" → Update `STRIPE_PUBLISHABLE_KEY`
3. Copy "Secret key" → Update `STRIPE_SECRET_KEY`

### Test Cards

Use Stripe test cards for development:

| Card Number | Description |
|------------|-------------|
| 4242 4242 4242 4242 | Successful payment |
| 4000 0000 0000 9995 | Declined payment |
| 4000 0000 0000 3220 | 3D Secure authentication |

Expiry: Any future date
CVC: Any 3 digits
ZIP: Any 5 digits

### Webhook Testing

Use Stripe CLI for local webhook testing:

```bash
# Install Stripe CLI
brew install stripe/stripe-cli/stripe

# Login
stripe login

# Forward webhooks to local
stripe listen --forward-to localhost:8660/wp-json/stripe/webhook

# Trigger test webhook
stripe trigger payment_intent.succeeded
```

## Performance Optimization

### Clear WordPress Cache

```bash
# WP-CLI
docker compose exec wordpress wp cache flush --allow-root

# Or in WordPress admin:
# Plugins → WooCommerce → Status → Tools → Clear transients
```

### Optimize Database

```bash
docker compose exec wordpress wp db optimize --allow-root
```

### Monitor Performance

```bash
# Check container resource usage
docker stats

# Check disk space
df -h

# Check Docker disk usage
docker system df
```

## Backup and Export

### Full Export for Production

Use the export script to create a complete backup:

```bash
# Create full export
bash export-docker.sh

# Creates: lovemyfluffy-export/lovemyfluffy-export-TIMESTAMP.tar.gz
```

This includes:
- Database dump
- WordPress files
- Docker volumes
- Docker images
- Configuration

### Quick Database Export

```bash
# Export database only
docker compose exec mysql mysqldump \
  -uwordpress -pwordpress_secure_password_2025 \
  lovemyfluffy > backups/dev-db-$(date +%Y%m%d).sql
```

## Next Steps

1. **Start Development**:
   ```bash
   docker compose up -d
   ```

2. **Access Site**:
   - Browse to http://localhost:8660
   - Login to WP Admin: http://localhost:8660/wp-admin

3. **Make Changes**:
   - Develop features
   - Test locally

4. **Deploy to Production**:
   - Commit and push to GitHub
   - GitHub Actions handles deployment automatically
   - See [DEPLOYMENT.md](DEPLOYMENT.md) for setup

## Resources

- [Docker Compose Docs](https://docs.docker.com/compose/)
- [WordPress Developer Docs](https://developer.wordpress.org/)
- [WooCommerce Docs](https://woocommerce.com/documentation/)
- [Stripe Testing](https://stripe.com/docs/testing)
- [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

## Support

**Common commands quick reference**:
```bash
# Start development
docker compose up -d

# View logs
docker compose logs -f

# Health check
bash scripts/health-check.sh

# Stop development
docker compose down
```

For deployment issues, see [DEPLOYMENT.md](DEPLOYMENT.md)

---

**Last Updated**: 2025-11-20
**Environment**: Development (Local Mac)
