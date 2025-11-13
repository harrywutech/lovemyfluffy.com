# Docker Migration Guide

This guide explains how to export and import your entire LoveMyFluffy Docker setup, including containers, volumes, and database.

## Overview

The migration process uses two scripts:
- **export-docker.sh** - Exports everything from the source machine
- **import-docker.sh** - Imports everything to the target machine

## Export Process

### On the Source Machine

1. **Run the export script:**
   ```bash
   ./export-docker.sh
   ```

2. **What gets exported:**
   - Docker volumes (wordpress_data, mysql_data)
   - MySQL database dump
   - Docker images (nginx, wordpress, mysql)
   - All project files (excluding .git, node_modules, logs, etc.)
   - Environment template (.env.example)

3. **Output:**
   - Creates `lovemyfluffy-export/lovemyfluffy-export-TIMESTAMP/` directory
   - Creates compressed archive: `lovemyfluffy-export/lovemyfluffy-export-TIMESTAMP.tar.gz`
   - Includes MANIFEST.txt with export details

### Transfer to Target Machine

**Option 1: Using SCP**
```bash
scp lovemyfluffy-export/lovemyfluffy-export-*.tar.gz user@target-machine:/path/to/destination/
```

**Option 2: Using rsync (extracted directory)**
```bash
rsync -av lovemyfluffy-export/lovemyfluffy-export-*/ user@target-machine:/path/to/destination/
```

**Option 3: Using external drive/USB**
- Copy the `.tar.gz` file to external storage
- Transfer to target machine

## Import Process

### On the Target Machine

1. **Extract the archive (if using .tar.gz):**
   ```bash
   tar xzf lovemyfluffy-export-TIMESTAMP.tar.gz
   ```

2. **Navigate to project directory:**
   ```bash
   cd lovemyfluffy.com  # or your project directory
   ```

3. **Ensure export directory is present:**
   - The export should be in `lovemyfluffy-export/lovemyfluffy-export-TIMESTAMP/`
   - Or extract it directly in the project root

4. **Run the import script:**
   ```bash
   ./import-docker.sh
   ```

5. **Configure environment:**
   - If `.env` doesn't exist, the script will create it from `.env.example`
   - Edit `.env` with your target machine's configuration
   - Update database passwords, URLs, and security keys

6. **Verify:**
   ```bash
   docker compose ps
   docker compose logs
   ```

## What Gets Migrated

### ✅ Included:
- WordPress database (all tables, data, settings)
- WordPress uploads/media files (from wordpress_data volume)
- MySQL data directory
- Docker images
- Project source code
- Configuration files

### ❌ Excluded (by design):
- `.git` directory
- `node_modules`
- Log files
- Cache files
- `.env` file (sensitive data - use template)

## Environment Variables

Before importing, ensure your `.env` file has correct values for the target machine:

```bash
# Database Configuration
MYSQL_ROOT_PASSWORD=your_secure_password
MYSQL_DATABASE=lovemyfluffy
MYSQL_USER=wordpress
MYSQL_PASSWORD=your_secure_password

# WordPress Configuration
WORDPRESS_DB_HOST=mysql
WORDPRESS_DB_NAME=lovemyfluffy
WORDPRESS_DB_USER=wordpress
WORDPRESS_DB_PASSWORD=your_secure_password
WORDPRESS_HOME=http://your-domain:8660
WORDPRESS_SITEURL=http://your-domain:8660

# WordPress Security Keys
# Generate new ones at: https://api.wordpress.org/secret-key/1.1/salt/
WORDPRESS_AUTH_KEY=...
WORDPRESS_SECURE_AUTH_KEY=...
# ... (all 8 keys)

# Nginx Configuration
NGINX_PORT=8660
```

## Troubleshooting

### Export Issues

**Volume not found:**
- Ensure containers are running: `docker compose ps`
- Check volume exists: `docker volume ls`

**Database export fails:**
- Ensure MySQL container is running
- Check `.env` has correct database credentials

### Import Issues

**Containers won't start:**
- Check `.env` file has correct values
- Verify ports are available: `lsof -i :8660`
- Check Docker has enough resources

**Database import fails:**
- Wait for MySQL to fully initialize (script waits automatically)
- Check database credentials in `.env`
- Review logs: `docker compose logs mysql`

**Volume import fails:**
- Ensure Docker has enough disk space
- Check volume permissions

### Common Commands

```bash
# Check container status
docker compose ps

# View logs
docker compose logs [service-name]

# Restart services
docker compose restart

# Stop everything
docker compose down

# Start fresh (removes volumes - DANGER!)
docker compose down -v
```

## Best Practices

1. **Before export:**
   - Stop unnecessary services
   - Verify all containers are healthy
   - Check disk space

2. **During transfer:**
   - Verify file integrity (checksums)
   - Use secure transfer methods (SCP, rsync over SSH)

3. **After import:**
   - Verify all containers are running
   - Test the website
   - Update WordPress URLs if domain changed
   - Regenerate security keys
   - Update file permissions if needed

## File Structure

```
lovemyfluffy-export/
└── lovemyfluffy-export-TIMESTAMP/
    ├── MANIFEST.txt           # Export metadata
    ├── .env.example           # Environment template
    ├── volumes/
    │   ├── wordpress_data.tar.gz
    │   └── mysql_data.tar.gz
    ├── database/
    │   ├── dump.sql           # WordPress database
    │   └── all_databases.sql  # All databases
    ├── images/
    │   ├── nginx-image.tar
    │   ├── wordpress-image.tar
    │   └── mysql-image.tar
    └── project/               # All project files
        ├── docker-compose.yml
        ├── nginx/
        ├── wordpress/
        └── ...
```

## Notes

- The export process creates a compressed archive for easy transfer
- Database dumps use `--single-transaction` for consistency
- Volumes are exported as tar.gz archives
- Images are saved in Docker's native format
- The import script automatically handles volume creation and data restoration

