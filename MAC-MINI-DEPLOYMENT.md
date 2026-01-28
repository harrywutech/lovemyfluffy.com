# Mac Mini 生产环境部署指南

本指南详细说明如何在 Mac mini 上部署 LoveMyFluffy.com 生产环境。

## 架构说明

### 环境分离

- **Manus（Staging）**: 开发和测试环境
  - URL: `http://localhost:8660`
  - 用途: 主题安装、内容测试、功能开发
  - 数据: 测试数据
  
- **Mac mini（Production）**: 生产环境
  - URL: `https://lovemyfluffy.com`（或您的域名）
  - 用途: 面向客户的正式网站
  - 数据: 真实客户数据

### 工作流程

```
开发 → Manus (测试) → Git Push → Mac mini (生产)
```

---

## 前置准备

### 1. Mac mini 系统要求

- **操作系统**: macOS 12.0 (Monterey) 或更高
- **内存**: 8GB 或以上
- **存储**: 至少 50GB 可用空间
- **网络**: 稳定的互联网连接

### 2. 安装必需软件

#### 安装 Homebrew

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

#### 安装 Docker Desktop

```bash
# 方法 1: 使用 Homebrew
brew install --cask docker

# 方法 2: 手动下载
# 访问 https://www.docker.com/products/docker-desktop
# 下载并安装 Docker Desktop for Mac
```

启动 Docker Desktop 并确保它在后台运行。

#### 安装 Git

```bash
brew install git
```

#### 配置 Git

```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

---

## 部署步骤

### 步骤 1: 克隆仓库

```bash
# 创建项目目录
mkdir -p ~/Sites
cd ~/Sites

# 克隆仓库
git clone https://github.com/harrywutech/lovemyfluffy.com.git
cd lovemyfluffy.com
```

### 步骤 2: 配置环境变量

```bash
# 复制环境变量模板
cp .env.template .env

# 编辑 .env 文件
nano .env
```

**生产环境配置示例**：

```bash
# =============================================================================
# DATABASE CONFIGURATION
# =============================================================================
MYSQL_ROOT_PASSWORD=your_very_secure_root_password_here_2025
MYSQL_DATABASE=lovemyfluffy
MYSQL_USER=wordpress
MYSQL_PASSWORD=your_very_secure_wordpress_password_here_2025

# =============================================================================
# WORDPRESS CONFIGURATION
# =============================================================================

# WordPress URLs - 使用您的实际域名
WORDPRESS_HOME=https://lovemyfluffy.com
WORDPRESS_SITEURL=https://lovemyfluffy.com

# WordPress Debug Mode - 生产环境关闭调试
WORDPRESS_DEBUG=false
WORDPRESS_DEBUG_LOG=false
WORDPRESS_DEBUG_DISPLAY=false

# =============================================================================
# PORT CONFIGURATION
# =============================================================================

# WordPress port - 生产环境使用 80 端口
WORDPRESS_PORT=80

# phpMyAdmin port (可选)
PHPMYADMIN_PORT=8661
```

**重要提示**：
- ⚠️ 使用强密码（建议 20+ 字符，包含大小写字母、数字、特殊字符）
- ⚠️ 不要将 `.env` 文件提交到 Git
- ⚠️ 生产环境必须关闭调试模式

保存并退出：`Ctrl + X`，然后 `Y`，再按 `Enter`

### 步骤 3: 启动 Docker 服务

```bash
# 使用生产配置启动
docker compose -f docker-compose-production.yml up -d

# 查看服务状态
docker compose -f docker-compose-production.yml ps

# 查看日志
docker compose -f docker-compose-production.yml logs -f
```

等待服务启动（约 30-60 秒）。

### 步骤 4: 完成 WordPress 安装

#### 首次安装

1. 在浏览器中访问：`http://localhost`（如果使用 80 端口）
2. 选择语言：中文（简体）
3. 填写网站信息：
   - **网站标题**: LoveMyFluffy
   - **用户名**: admin（建议使用其他用户名）
   - **密码**: 使用强密码
   - **电子邮件**: 您的管理员邮箱
4. 点击 **安装 WordPress**

#### 从 Manus 迁移

如果您已在 Manus 上完成了主题安装和配置，可以导出数据库并导入到生产环境：

```bash
# 在 Manus 上导出数据库
docker exec lovemyfluffy_mysql mysqldump -uwordpress -pwordpress_secure_password_2025 lovemyfluffy > lovemyfluffy-staging.sql

# 将 SQL 文件复制到 Mac mini

# 在 Mac mini 上导入数据库
docker exec -i lovemyfluffy_mysql mysql -uwordpress -pyour_production_password lovemyfluffy < lovemyfluffy-staging.sql

# 更新站点 URL
docker exec lovemyfluffy_wordpress wp search-replace 'http://localhost:8660' 'https://lovemyfluffy.com' --allow-root
```

### 步骤 5: 安装 Petito 主题

```bash
# 运行主题安装脚本
bash install-petito-theme.sh
```

或者手动安装（参考 `PETITO-THEME-SETUP.md`）。

### 步骤 6: 导入 Demo 4 内容

1. 登录 WordPress 管理后台：`http://localhost/wp-admin`
2. 进入 **Theme Options > Import Demo Content**
3. 选择 **Demo 4**
4. 点击 **Import Now**
5. 等待导入完成（10-15 分钟）

详细步骤请参考 `PETITO-THEME-SETUP.md`。

---

## 域名和 SSL 配置

### 方法 1: 使用 Nginx 反向代理（推荐）

#### 安装 Nginx

```bash
brew install nginx
```

#### 配置 Nginx

创建配置文件：

```bash
sudo nano /usr/local/etc/nginx/servers/lovemyfluffy.conf
```

添加以下内容：

```nginx
server {
    listen 80;
    server_name lovemyfluffy.com www.lovemyfluffy.com;

    # 重定向到 HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name lovemyfluffy.com www.lovemyfluffy.com;

    # SSL 证书路径（使用 Let's Encrypt）
    ssl_certificate /usr/local/etc/nginx/ssl/lovemyfluffy.com/fullchain.pem;
    ssl_certificate_key /usr/local/etc/nginx/ssl/lovemyfluffy.com/privkey.pem;

    # SSL 配置
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    # 反向代理到 Docker WordPress
    location / {
        proxy_pass http://localhost:80;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # 日志
    access_log /usr/local/var/log/nginx/lovemyfluffy.access.log;
    error_log /usr/local/var/log/nginx/lovemyfluffy.error.log;
}
```

#### 获取 SSL 证书（Let's Encrypt）

```bash
# 安装 Certbot
brew install certbot

# 获取证书
sudo certbot certonly --standalone -d lovemyfluffy.com -d www.lovemyfluffy.com

# 证书会保存在 /etc/letsencrypt/live/lovemyfluffy.com/
# 创建 Nginx SSL 目录并复制证书
sudo mkdir -p /usr/local/etc/nginx/ssl/lovemyfluffy.com
sudo cp /etc/letsencrypt/live/lovemyfluffy.com/fullchain.pem /usr/local/etc/nginx/ssl/lovemyfluffy.com/
sudo cp /etc/letsencrypt/live/lovemyfluffy.com/privkey.pem /usr/local/etc/nginx/ssl/lovemyfluffy.com/
```

#### 启动 Nginx

```bash
# 测试配置
sudo nginx -t

# 启动 Nginx
sudo brew services start nginx

# 重启 Nginx
sudo brew services restart nginx
```

#### 自动续期 SSL 证书

```bash
# 添加 cron 任务
crontab -e

# 添加以下行（每天凌晨 2 点检查并续期）
0 2 * * * certbot renew --quiet && brew services restart nginx
```

### 方法 2: 使用 Cloudflare（简单方式）

1. 注册 Cloudflare 账号
2. 添加您的域名
3. 更新域名 DNS 到 Cloudflare 提供的 NS 服务器
4. 在 Cloudflare 中启用 SSL/TLS（Full 模式）
5. 添加 A 记录指向 Mac mini 的公网 IP

---

## 性能优化

### 1. 启用 Redis 缓存（可选）

```yaml
# 在 docker-compose-production.yml 中添加
services:
  redis:
    image: redis:alpine
    container_name: lovemyfluffy_redis
    restart: unless-stopped
    networks:
      - lovemyfluffy-network
```

安装 Redis 插件：

```bash
docker exec lovemyfluffy_wordpress wp plugin install redis-cache --activate --allow-root
docker exec lovemyfluffy_wordpress wp redis enable --allow-root
```

### 2. 配置 WP Cron

禁用 WordPress 默认 Cron，使用系统 Cron：

```bash
# 在 .env 中添加
WORDPRESS_CONFIG_EXTRA: |
  define('DISABLE_WP_CRON', true);
```

添加系统 Cron 任务：

```bash
crontab -e

# 添加以下行（每 15 分钟运行一次）
*/15 * * * * docker exec lovemyfluffy_wordpress wp cron event run --due-now --allow-root
```

### 3. 图片优化

安装图片优化插件：

```bash
docker exec lovemyfluffy_wordpress wp plugin install ewww-image-optimizer --activate --allow-root
```

---

## 备份策略

### 1. 数据库备份

创建备份脚本 `backup-database.sh`：

```bash
#!/bin/bash
# 数据库备份脚本

BACKUP_DIR="$HOME/Sites/lovemyfluffy.com/backups"
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="$BACKUP_DIR/lovemyfluffy_db_$DATE.sql"

mkdir -p "$BACKUP_DIR"

docker exec lovemyfluffy_mysql mysqldump \
  -uwordpress -pyour_production_password \
  lovemyfluffy > "$BACKUP_FILE"

# 压缩备份
gzip "$BACKUP_FILE"

# 删除 30 天前的备份
find "$BACKUP_DIR" -name "*.sql.gz" -mtime +30 -delete

echo "Backup completed: $BACKUP_FILE.gz"
```

设置自动备份：

```bash
chmod +x backup-database.sh

# 添加 cron 任务（每天凌晨 3 点备份）
crontab -e
0 3 * * * /Users/yourusername/Sites/lovemyfluffy.com/backup-database.sh
```

### 2. 文件备份

使用 Time Machine 或 rsync：

```bash
# 使用 rsync 备份到外部硬盘
rsync -av --delete \
  ~/Sites/lovemyfluffy.com/ \
  /Volumes/Backup/lovemyfluffy.com/
```

---

## 监控和维护

### 1. 健康检查

创建健康检查脚本 `health-check.sh`：

```bash
#!/bin/bash
# 健康检查脚本

echo "Checking Docker services..."
docker compose -f docker-compose-production.yml ps

echo ""
echo "Checking WordPress status..."
curl -f http://localhost/ > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✓ WordPress is running"
else
    echo "✗ WordPress is not responding"
fi

echo ""
echo "Checking MySQL status..."
docker exec lovemyfluffy_mysql mysqladmin ping -h localhost > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✓ MySQL is running"
else
    echo "✗ MySQL is not responding"
fi

echo ""
echo "Disk usage:"
df -h ~/Sites/lovemyfluffy.com

echo ""
echo "Docker volumes:"
docker volume ls | grep lovemyfluffy
```

### 2. 日志查看

```bash
# WordPress 日志
docker compose -f docker-compose-production.yml logs -f wordpress

# MySQL 日志
docker compose -f docker-compose-production.yml logs -f mysql

# Nginx 日志（如果使用）
tail -f /usr/local/var/log/nginx/lovemyfluffy.access.log
tail -f /usr/local/var/log/nginx/lovemyfluffy.error.log
```

### 3. 更新维护

```bash
# 更新 WordPress 核心
docker exec lovemyfluffy_wordpress wp core update --allow-root

# 更新插件
docker exec lovemyfluffy_wordpress wp plugin update --all --allow-root

# 更新主题
docker exec lovemyfluffy_wordpress wp theme update --all --allow-root

# 优化数据库
docker exec lovemyfluffy_wordpress wp db optimize --allow-root
```

---

## 故障排除

### 问题 1: 容器无法启动

```bash
# 查看详细日志
docker compose -f docker-compose-production.yml logs

# 重新构建并启动
docker compose -f docker-compose-production.yml down
docker compose -f docker-compose-production.yml up -d --build
```

### 问题 2: 数据库连接失败

```bash
# 检查 MySQL 容器状态
docker exec lovemyfluffy_mysql mysqladmin ping -h localhost

# 重启 MySQL
docker compose -f docker-compose-production.yml restart mysql

# 检查环境变量
docker exec lovemyfluffy_wordpress env | grep WORDPRESS_DB
```

### 问题 3: 网站无法访问

```bash
# 检查端口占用
lsof -i :80
lsof -i :443

# 检查 Nginx 配置
sudo nginx -t

# 重启 Nginx
sudo brew services restart nginx
```

### 问题 4: SSL 证书问题

```bash
# 检查证书有效期
openssl x509 -in /usr/local/etc/nginx/ssl/lovemyfluffy.com/fullchain.pem -noout -dates

# 手动续期证书
sudo certbot renew

# 重启 Nginx
sudo brew services restart nginx
```

---

## 安全建议

### 1. 防火墙配置

```bash
# macOS 启用防火墙
sudo /usr/libexec/ApplicationFirewall/socketfilterfw --setglobalstate on

# 只允许必要的端口
sudo /usr/libexec/ApplicationFirewall/socketfilterfw --add /usr/local/bin/nginx
```

### 2. WordPress 安全

- ✅ 使用强密码
- ✅ 定期更新 WordPress、主题和插件
- ✅ 安装安全插件（如 Wordfence）
- ✅ 限制登录尝试次数
- ✅ 禁用文件编辑器
- ✅ 使用 SSL/HTTPS
- ✅ 定期备份

### 3. 数据库安全

```bash
# 更改 MySQL root 密码
docker exec -it lovemyfluffy_mysql mysql -uroot -p
ALTER USER 'root'@'localhost' IDENTIFIED BY 'new_strong_password';
FLUSH PRIVILEGES;
```

---

## 从 Staging 到 Production 的工作流

### 1. 在 Manus (Staging) 开发

```bash
# 在 Manus 上进行开发和测试
cd /path/to/lovemyfluffy.com
docker compose -f docker-compose-production.yml up -d

# 进行主题配置、内容编辑等
```

### 2. 导出 Staging 数据

```bash
# 导出数据库
docker exec lovemyfluffy_mysql mysqldump \
  -uwordpress -pwordpress_secure_password_2025 \
  lovemyfluffy > staging-export.sql

# 导出上传文件
tar -czf uploads.tar.gz wordpress/wp-content/uploads/
```

### 3. 提交到 Git

```bash
git add .
git commit -m "Update: theme configuration and content"
git push origin main
```

### 4. 在 Mac mini (Production) 部署

```bash
# 拉取最新代码
cd ~/Sites/lovemyfluffy.com
git pull origin main

# 导入数据库（如果需要）
docker exec -i lovemyfluffy_mysql mysql \
  -uwordpress -pyour_production_password \
  lovemyfluffy < staging-export.sql

# 更新站点 URL
docker exec lovemyfluffy_wordpress wp search-replace \
  'http://localhost:8660' 'https://lovemyfluffy.com' --allow-root

# 导入上传文件（如果需要）
tar -xzf uploads.tar.gz -C wordpress/wp-content/

# 重启服务
docker compose -f docker-compose-production.yml restart
```

---

## 快速命令参考

```bash
# 启动服务
docker compose -f docker-compose-production.yml up -d

# 停止服务
docker compose -f docker-compose-production.yml down

# 重启服务
docker compose -f docker-compose-production.yml restart

# 查看日志
docker compose -f docker-compose-production.yml logs -f

# 进入 WordPress 容器
docker exec -it lovemyfluffy_wordpress bash

# 进入 MySQL 容器
docker exec -it lovemyfluffy_mysql bash

# 备份数据库
docker exec lovemyfluffy_mysql mysqldump -uwordpress -p lovemyfluffy > backup.sql

# 恢复数据库
docker exec -i lovemyfluffy_mysql mysql -uwordpress -p lovemyfluffy < backup.sql

# 清除缓存
docker exec lovemyfluffy_wordpress wp cache flush --allow-root

# 更新 WordPress
docker exec lovemyfluffy_wordpress wp core update --allow-root

# 健康检查
bash health-check.sh
```

---

## 总结

完成以上步骤后，您的 LoveMyFluffy.com 网站将在 Mac mini 上成功运行：

- ✅ Docker 环境配置完成
- ✅ WordPress 和 MySQL 运行正常
- ✅ Petito 主题已安装
- ✅ Demo 4 内容已导入
- ✅ SSL 证书已配置
- ✅ 备份策略已设置
- ✅ 监控和维护脚本就绪

**下一步**：开始添加您的产品和内容，配置支付网关，测试购物流程！

---

**需要帮助？** 查看以下文档：
- `PETITO-THEME-SETUP.md` - 主题详细配置
- `README.md` - 项目概览
- `DEVELOPMENT.md` - 开发环境指南
