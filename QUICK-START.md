# LoveMyFluffy.com - 快速开始指南

欢迎！本指南将帮助您在 **5 分钟内** 启动 LoveMyFluffy.com 网站。

## 🚀 快速开始（Mac mini）

### 1. 安装 Docker

```bash
# 安装 Homebrew（如果还没有）
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# 安装 Docker Desktop
brew install --cask docker
```

启动 Docker Desktop 应用。

### 2. 克隆项目

```bash
mkdir -p ~/Sites
cd ~/Sites
git clone https://github.com/harrywutech/lovemyfluffy.com.git
cd lovemyfluffy.com
```

### 3. 配置环境

```bash
# 复制环境变量模板
cp .env.template .env

# 编辑 .env 文件（使用您喜欢的编辑器）
nano .env
```

**最小配置**（修改密码）：

```bash
MYSQL_ROOT_PASSWORD=your_secure_password_here
MYSQL_PASSWORD=your_wordpress_password_here
WORDPRESS_HOME=http://localhost:8660
WORDPRESS_SITEURL=http://localhost:8660
```

保存并退出（Ctrl+X, Y, Enter）。

### 4. 启动服务

```bash
docker compose -f docker-compose-production.yml up -d
```

等待 30 秒让服务启动。

### 5. 访问网站

打开浏览器访问：**http://localhost:8660**

按照 WordPress 安装向导完成初始设置。

### 6. 安装 Petito 主题

```bash
bash install-petito-theme.sh
```

### 7. 导入 Demo 4

1. 访问：http://localhost:8660/wp-admin
2. 进入：**Theme Options > Import Demo Content**
3. 选择 **Demo 4**
4. 点击 **Import Now**
5. 等待 10-15 分钟

**完成！** 🎉 您的网站现在应该看起来像演示站点了。

---

## 📚 详细文档

- **[MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md)** - 完整的生产环境部署指南
- **[PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md)** - Petito 主题详细配置
- **[DEVELOPMENT.md](DEVELOPMENT.md)** - 开发环境指南
- **[DEPLOYMENT.md](DEPLOYMENT.md)** - 原有的部署文档

---

## 🔧 常用命令

```bash
# 启动服务
docker compose -f docker-compose-production.yml up -d

# 停止服务
docker compose -f docker-compose-production.yml down

# 查看日志
docker compose -f docker-compose-production.yml logs -f

# 重启服务
docker compose -f docker-compose-production.yml restart
```

---

## ❓ 遇到问题？

### 端口被占用

如果 8660 端口被占用，修改 `.env` 中的 `WORDPRESS_PORT`：

```bash
WORDPRESS_PORT=8661  # 或其他可用端口
```

### Docker 无法启动

```bash
# 清理并重新启动
docker compose -f docker-compose-production.yml down
docker system prune -f
docker compose -f docker-compose-production.yml up -d
```

### 主题导入失败

参考 [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md) 中的"常见问题"部分。

---

## 📞 获取帮助

- 查看详细文档：`PETITO-THEME-SETUP.md`
- 查看主题文档：`wordpress/theme-files/Documentation/index.html`
- 查看 Docker 日志：`docker compose logs -f`

---

**祝您使用愉快！** 🐾
