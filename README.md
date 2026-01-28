# LoveMyFluffy.com - WordPress E-commerce Platform

A Docker-based WordPress/WooCommerce e-commerce platform for pet supplies with automated CI/CD deployment.

## Quick Start

### Development (This Mac)

```bash
# Start development environment
docker compose up -d

# Access site
open http://localhost:8660

# View logs
docker compose logs -f

# Stop environment
docker compose down
```

**Full development guide**: See [DEVELOPMENT.md](DEVELOPMENT.md)

### Production Deployment

Push to `main` branch triggers automatic deployment via GitHub Actions.

**Full deployment guide**: See [DEPLOYMENT.md](DEPLOYMENT.md)

## Project Structure

```
lovemyfluffy.com/
├── .github/workflows/     # CI/CD pipelines
│   ├── ci.yml            # Build & test
│   └── deploy.yml        # Production deployment
├── wordpress/            # WordPress core & content
├── nginx/                # Nginx web server config
├── database/             # Database initialization
├── scripts/              # Deployment & health check scripts
├── docker-compose.yml    # Docker services configuration
├── .env                  # Environment variables (local)
├── DEVELOPMENT.md        # Development environment guide
└── DEPLOYMENT.md         # Production deployment guide
```

## Features

✅ **Docker-First Development**: Containerized services (WordPress, MySQL, Nginx)
✅ **Automated CI/CD**: GitHub Actions for testing and deployment
✅ **Health Monitoring**: Comprehensive health check scripts
✅ **Database Backups**: Automatic backups before deployment
✅ **Rollback Support**: Automatic rollback on deployment failure
✅ **Security Scanning**: Trivy vulnerability scanning
✅ **Zero-Downtime Deployment**: Graceful container restarts

## Tech Stack

- **WordPress**: 6.4+ with PHP 8.2+
- **WooCommerce**: E-commerce functionality
- **MySQL**: 8.0 database
- **Nginx**: Web server
- **Docker**: Containerization
- **GitHub Actions**: CI/CD automation
- **Stripe**: Payment processing (test/live modes)

## Documentation

| Document | Description |
|----------|-------------|
| [DEVELOPMENT.md](DEVELOPMENT.md) | Local development setup and workflow |
| [DEPLOYMENT.md](DEPLOYMENT.md) | Production deployment via GitHub Actions |
| [DOCKER-MIGRATION.md](DOCKER-MIGRATION.md) | Docker container migration guide |

## Environment Setup

### This Mac (Development)

✅ Configured for local development:
- URL: http://localhost:8660
- Debug mode: Enabled
- Stripe: Test mode
- Access: Direct file editing

### Production Mac (Deployment Target)

Configured for production:
- URL: Your production domain
- Debug mode: Disabled
- Stripe: Live mode
- Access: Via Git deployment only

## Common Commands

```bash
# Development
docker compose up -d              # Start services
docker compose down               # Stop services
docker compose logs -f            # View logs
bash scripts/health-check.sh      # Run health checks

# Git workflow
git add .                         # Stage changes
git commit -m "Description"       # Commit changes
git push origin main              # Push & trigger deployment

# WordPress
docker compose exec wordpress wp --allow-root ...   # WP-CLI commands

# Database
docker compose exec mysql mysql -u... -p... ...     # MySQL access
```

## Support & Resources

- **Development Issues**: Check [DEVELOPMENT.md](DEVELOPMENT.md)
- **Deployment Issues**: Check [DEPLOYMENT.md](DEPLOYMENT.md)
- **Container Issues**: Check [DOCKER-MIGRATION.md](DOCKER-MIGRATION.md)

## Project Status

**Current Status**: Development environment configured
**Next Steps**:
1. Complete WordPress installation
2. Configure GitHub Secrets for deployment
3. Set up production Mac environment

---

**Last Updated**: 2025-11-20
