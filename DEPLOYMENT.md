# Deployment Guide - LoveMyFluffy.com

Complete guide for deploying your Docker-based WordPress/WooCommerce site from development to production Mac.

## Table of Contents

- [Overview](#overview)
- [Prerequisites](#prerequisites)
- [Setup Methods](#setup-methods)
  - [Method A: SSH Deployment (Recommended)](#method-a-ssh-deployment-recommended)
  - [Method B: Self-Hosted Runner](#method-b-self-hosted-runner)
- [Configuration](#configuration)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)
- [Rollback](#rollback)

## Overview

This project uses **GitHub Actions** for automated CI/CD. The deployment workflow:

1. ✅ Runs automated tests on every push
2. 🔒 Creates database backups before deployment
3. 🚀 Deploys to production Mac via SSH
4. 🏥 Runs health checks to verify deployment
5. 🔄 Supports automatic rollback on failure

## Prerequisites

### On Development Mac

- Git configured with GitHub repository
- Docker and Docker Compose installed
- Push access to GitHub repository

### On Production Mac

- macOS with Docker Desktop installed
- SSH access enabled (System Preferences → Sharing → Remote Login)
- Git installed
- Project cloned to production location (e.g., `~/lovemyfluffy.com`)
- `.env` file configured with production settings

## Setup Methods

### Method A: SSH Deployment (Recommended)

This method uses GitHub-hosted runners to deploy via SSH to your production Mac.

#### Step 1: Generate SSH Key Pair

On your **development machine**, generate a dedicated SSH key for deployment:

```bash
ssh-keygen -t ed25519 -a 200 -C "github-actions-deploy" -f ~/.ssh/lovemyfluffy-deploy
```

This creates:
- Private key: `~/.ssh/lovemyfluffy-deploy`
- Public key: `~/.ssh/lovemyfluffy-deploy.pub`

#### Step 2: Configure Production Mac

1. **Copy public key to production Mac**:

```bash
# From development Mac:
ssh-copy-id -i ~/.ssh/lovemyfluffy-deploy.pub user@production-mac-ip
```

Or manually:

```bash
# On production Mac:
mkdir -p ~/.ssh
chmod 700 ~/.ssh

# Paste public key content into:
nano ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

2. **Test SSH connection**:

```bash
# From development Mac:
ssh -i ~/.ssh/lovemyfluffy-deploy user@production-mac-ip
```

3. **Prepare production directory**:

```bash
# On production Mac:
cd ~/lovemyfluffy.com

# Ensure .env file exists with production settings
cp .env.example .env
nano .env  # Update with production values

# Create backup directory
mkdir -p backups

# Make scripts executable
chmod +x scripts/*.sh
```

#### Step 3: Configure GitHub Secrets

Add these secrets to your GitHub repository (Settings → Secrets and variables → Actions):

| Secret Name | Description | Example |
|------------|-------------|---------|
| `DEPLOY_HOST` | Production Mac IP or hostname | `192.168.1.100` or `my-mac.local` |
| `DEPLOY_USERNAME` | SSH username on production Mac | `your-username` |
| `DEPLOY_SSH_KEY` | **Private key** content | Contents of `~/.ssh/lovemyfluffy-deploy` |
| `DEPLOY_PORT` | SSH port (usually 22) | `22` |

**To add the private key**:

```bash
# Copy private key to clipboard (macOS)
cat ~/.ssh/lovemyfluffy-deploy | pbcopy

# Then paste into GitHub Secret: DEPLOY_SSH_KEY
```

#### Step 4: Verify Setup

1. **Check production Mac network access**:
   - If on local network, ensure Mac is accessible
   - If remote, consider VPN or static IP
   - Update firewall rules if needed

2. **Test deployment workflow**:
   - Push a commit to `main` branch
   - Check GitHub Actions tab for workflow progress
   - Monitor deployment logs

### Method B: Self-Hosted Runner

For more control and faster deployments, install a GitHub Actions runner on your production Mac.

#### Step 1: Register Self-Hosted Runner

1. Go to GitHub repository → Settings → Actions → Runners
2. Click "New self-hosted runner"
3. Select macOS
4. Follow the installation instructions on production Mac:

```bash
# On production Mac:
mkdir -p ~/actions-runner && cd ~/actions-runner

# Download runner (check GitHub for latest version URL)
curl -o actions-runner-osx-x64-2.311.0.tar.gz -L https://github.com/actions/runner/releases/download/v2.311.0/actions-runner-osx-x64-2.311.0.tar.gz

# Extract
tar xzf ./actions-runner-osx-x64-2.311.0.tar.gz

# Configure
./config.sh --url https://github.com/yourusername/lovemyfluffy.com --token YOUR_TOKEN

# Install as service
./svc.sh install

# Start service
./svc.sh start
```

#### Step 2: Update Workflow

Modify [.github/workflows/deploy.yml](.github/workflows/deploy.yml) to use self-hosted runner:

```yaml
jobs:
  deploy:
    runs-on: self-hosted  # Change from ubuntu-latest
    steps:
      # Remove SSH step, run commands directly
      - name: Deploy locally
        run: |
          cd ~/lovemyfluffy.com
          bash scripts/deploy.sh
```

## Configuration

### Environment Variables

Production `.env` file should include:

```bash
# Database Configuration
MYSQL_ROOT_PASSWORD=<strong-password>
MYSQL_DATABASE=lovemyfluffy
MYSQL_USER=wordpress
MYSQL_PASSWORD=<strong-password>

# WordPress Configuration
WORDPRESS_DB_HOST=mysql
WORDPRESS_DB_NAME=lovemyfluffy
WORDPRESS_DB_USER=wordpress
WORDPRESS_DB_PASSWORD=<strong-password>
WORDPRESS_HOME=http://your-production-domain.com
WORDPRESS_SITEURL=http://your-production-domain.com

# Security Keys (generate from https://api.wordpress.org/secret-key/1.1/salt/)
WORDPRESS_AUTH_KEY=<generated-key>
WORDPRESS_SECURE_AUTH_KEY=<generated-key>
# ... etc

# Nginx Configuration
NGINX_PORT=80  # or 443 for HTTPS
```

### Deployment Path

Default deployment path is `~/lovemyfluffy.com`. To change:

1. Update `DEPLOY_PATH` in [.github/workflows/deploy.yml](.github/workflows/deploy.yml)
2. Ensure production Mac has code at that location

## Usage

### Automatic Deployment

Every push to `main` branch triggers:

1. **CI Workflow** (`.github/workflows/ci.yml`):
   - Builds Docker images
   - Runs tests
   - Checks for errors

2. **Deploy Workflow** (`.github/workflows/deploy.yml`):
   - Creates database backup
   - Pulls latest code
   - Rebuilds containers
   - Runs health checks

### Manual Deployment

#### Via GitHub Actions

1. Go to Actions tab in GitHub
2. Select "Deploy to Production" workflow
3. Click "Run workflow"
4. Choose options (e.g., skip backup)

#### Via SSH (Manual)

```bash
# SSH to production Mac
ssh user@production-mac-ip

# Navigate to project
cd ~/lovemyfluffy.com

# Run deployment script
bash scripts/deploy.sh

# Or with environment variables
SKIP_BACKUP=true bash scripts/deploy.sh
```

### Health Checks

Run health checks anytime:

```bash
# On production Mac
cd ~/lovemyfluffy.com
bash scripts/health-check.sh
```

Checks include:
- ✅ Container status
- ✅ MySQL connectivity
- ✅ WordPress accessibility
- ✅ Nginx configuration
- ✅ Volume integrity
- ✅ Disk space
- ✅ Log errors

## Troubleshooting

### Deployment Fails

**Check workflow logs**:
1. Go to GitHub Actions tab
2. Click failed workflow
3. Expand failed step
4. Check error messages

**Common issues**:

| Issue | Solution |
|-------|----------|
| SSH connection refused | Check production Mac Remote Login is enabled |
| Permission denied (publickey) | Verify SSH key is added to `authorized_keys` |
| Docker containers not starting | Check `.env` file and Docker logs |
| Database connection failed | Verify MySQL credentials in `.env` |

### Health Check Failures

```bash
# Check container logs
docker compose logs nginx
docker compose logs wordpress
docker compose logs mysql

# Restart services
docker compose restart

# Full reset (careful!)
docker compose down
docker compose up -d
```

### SSH Debugging

```bash
# Test SSH connection with verbose output
ssh -v -i ~/.ssh/lovemyfluffy-deploy user@production-mac-ip

# Check SSH key permissions
ls -la ~/.ssh/lovemyfluffy-deploy
# Should be: -rw------- (600)

# Check authorized_keys on production
ssh production-mac
cat ~/.ssh/authorized_keys | grep github-actions
```

### Network Issues

**Production Mac not reachable**:
- Check Mac is powered on and connected
- Verify IP address: `ifconfig | grep inet`
- Test ping: `ping production-mac-ip`
- Check firewall: System Preferences → Security & Privacy → Firewall

## Rollback

### Automatic Rollback

The deployment script automatically rolls back if:
- Health checks fail
- Container deployment fails
- Critical errors detected

Rollback process:
1. Stops new containers
2. Restores database from backup
3. Starts previous containers

### Manual Rollback

```bash
# On production Mac:
cd ~/lovemyfluffy.com

# Find backup file
ls -lh backups/

# Stop current containers
docker compose down

# Restore database
gunzip -c backups/db-backup-YYYYMMDD-HHMMSS.sql.gz | \
  docker compose exec -T mysql mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE}

# Revert code
git log --oneline  # Find commit hash
git reset --hard <commit-hash>

# Rebuild and start
docker compose build
docker compose up -d
```

### Emergency Stop

```bash
# Stop all services immediately
docker compose down

# Or specific service
docker compose stop wordpress
```

## Backup Management

### Automatic Backups

Backups are created before each deployment:
- Location: `backups/db-backup-TIMESTAMP.sql.gz`
- Compressed with gzip
- Includes all tables, routines, and triggers

### Manual Backup

```bash
# On production Mac:
cd ~/lovemyfluffy.com

# Run export script (full backup)
bash export-docker.sh

# Or just database
docker compose exec mysql mysqldump \
  -u${MYSQL_USER} -p${MYSQL_PASSWORD} \
  ${MYSQL_DATABASE} > backups/manual-backup-$(date +%Y%m%d).sql
```

### Cleanup Old Backups

```bash
# Keep only last 10 backups
cd backups
ls -t db-backup-*.sql.gz | tail -n +11 | xargs rm -f
```

## Security Best Practices

1. **SSH Keys**:
   - Use ED25519 keys (more secure than RSA)
   - Never commit private keys
   - Rotate keys periodically

2. **GitHub Secrets**:
   - Never expose secrets in logs
   - Use environment-specific secrets
   - Audit secret access regularly

3. **Production .env**:
   - Never commit production `.env`
   - Use strong passwords (20+ characters)
   - Generate unique WordPress salts

4. **Database**:
   - Keep backups offsite
   - Encrypt sensitive data
   - Regular backup testing

5. **Network**:
   - Use VPN for remote deployments
   - Restrict SSH to known IPs if possible
   - Enable Mac firewall

## Advanced Configuration

### HTTPS with Let's Encrypt

See [DOCKER-MIGRATION.md](DOCKER-MIGRATION.md) for SSL setup.

### Multiple Environments

Create separate workflows:
- `.github/workflows/deploy-staging.yml`
- `.github/workflows/deploy-production.yml`

Use different GitHub Secrets for each environment.

### Notifications

Add Slack/Discord notifications to workflow:

```yaml
- name: Notify Slack
  uses: slackapi/slack-github-action@v1
  with:
    webhook-url: ${{ secrets.SLACK_WEBHOOK }}
    payload: |
      {
        "text": "Deployment completed!"
      }
```

## Support

For issues or questions:
- Check GitHub Actions logs
- Review container logs: `docker compose logs`
- Test health checks: `bash scripts/health-check.sh`
- Consult [DOCKER-MIGRATION.md](DOCKER-MIGRATION.md) for container management

---

**Last Updated**: 2025-11-20
