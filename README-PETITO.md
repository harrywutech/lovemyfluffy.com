# LoveMyFluffy.com - Petito 主题版本

基于 Docker 的 WordPress/WooCommerce 宠物用品电商平台，使用 Petito 主题。

## 🎯 项目概述

LoveMyFluffy.com 是一个专业的宠物用品跨境电商网站，采用：

- **主题**: Petito - Creative Animals & Petshop WooCommerce Theme
- **演示版本**: Demo 4（宠物店布局）
- **技术栈**: Docker + WordPress + WooCommerce + MySQL
- **环境**: Manus (Staging) + Mac mini (Production)

## 🚀 快速开始

### 5 分钟快速启动

```bash
# 1. 克隆项目
git clone https://github.com/harrywutech/lovemyfluffy.com.git
cd lovemyfluffy.com

# 2. 配置环境
cp .env.template .env
nano .env  # 修改密码

# 3. 启动服务
docker compose -f docker-compose-production.yml up -d

# 4. 安装主题
bash install-petito-theme.sh

# 5. 访问网站
open http://localhost:8660
```

**详细步骤**: 查看 [QUICK-START.md](QUICK-START.md)

## 📁 项目结构

```
lovemyfluffy.com/
├── docker-compose-production.yml    # 生产环境 Docker 配置
├── .env.template                    # 环境变量模板
├── install-petito-theme.sh          # 主题自动安装脚本
├── wordpress/
│   ├── theme-files/                 # Petito 主题文件
│   │   ├── Theme/                   # 主题 ZIP 文件
│   │   │   ├── bw-petito.v1.6.5.zip
│   │   │   └── bw-petito-child.zip
│   │   ├── Bundled Plugins/         # 捆绑插件
│   │   │   └── revslider.zip
│   │   └── Documentation/           # 主题文档
│   └── wp-content/                  # WordPress 内容
├── database/                        # 数据库备份
└── docs/                            # 项目文档
```

## 📚 文档导航

### 核心文档

| 文档 | 说明 | 适用场景 |
|------|------|----------|
| [QUICK-START.md](QUICK-START.md) | 5 分钟快速开始 | 首次使用 |
| [MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md) | Mac mini 完整部署指南 | 生产环境部署 |
| [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md) | Petito 主题详细配置 | 主题安装和配置 |
| [DEVELOPMENT.md](DEVELOPMENT.md) | 开发环境指南 | 本地开发 |

### 主题文档

- **主题官方文档**: `wordpress/theme-files/Documentation/index.html`
- **主题版本**: v1.6.5
- **演示站点**: [查看 Demo 4](http://bw-petito-demo4.bzotech.com/)

## ✨ 功能特性

### Petito 主题特性

- ✅ **多个演示版本**: 包含 Demo 4 宠物店布局
- ✅ **WooCommerce 集成**: 完整的电商功能
- ✅ **Elementor 页面构建器**: 拖拽式页面编辑
- ✅ **Revolution Slider**: 强大的轮播图功能
- ✅ **响应式设计**: 完美支持移动端
- ✅ **Newsletter 弹窗**: 邮件订阅功能
- ✅ **产品分类图标**: 精美的分类展示
- ✅ **移动端底部栏**: 优化的移动端导航

### 技术特性

- ✅ **Docker 容器化**: 环境一致性
- ✅ **自动化安装脚本**: 一键安装主题
- ✅ **环境分离**: Staging 和 Production
- ✅ **数据库备份**: 自动备份策略
- ✅ **SSL 支持**: HTTPS 配置
- ✅ **性能优化**: Redis 缓存支持

## 🔧 环境配置

### Staging 环境（Manus）

```bash
WORDPRESS_HOME=http://localhost:8660
WORDPRESS_DEBUG=true
```

用途：开发、测试、主题配置

### Production 环境（Mac mini）

```bash
WORDPRESS_HOME=https://lovemyfluffy.com
WORDPRESS_DEBUG=false
```

用途：正式网站、客户访问

## 📦 主题安装

### 自动安装（推荐）

```bash
bash install-petito-theme.sh
```

脚本会自动完成：
1. 安装 Petito 主题（父主题 + 子主题）
2. 安装 WooCommerce
3. 安装 Elementor
4. 安装 Revolution Slider
5. 配置 WordPress 设置

### 手动安装

详细步骤请查看 [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md)

## 🎨 Demo 4 导入

Demo 4 是专为宠物店设计的演示版本，包含：

- 🏠 完整的首页布局
- 🛍️ 产品分类（Dog Food, Fish Food, Hamster Food, Pet's Toy, Pet's House）
- 📦 示例产品
- 🎠 轮播图和横幅
- 📧 Newsletter 弹窗
- 📱 移动端优化

### 导入步骤

1. 访问：`http://localhost:8660/wp-admin`
2. 进入：**Theme Options > Import Demo Content**
3. 选择：**Demo 4**
4. 点击：**Import Now**
5. 等待：10-15 分钟

详细说明请查看 [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md#demo-4-导入)

## 🚢 部署流程

### Staging → Production 工作流

```
1. 在 Manus 开发和测试
   ↓
2. 配置主题和内容
   ↓
3. 提交到 Git
   ↓
4. 在 Mac mini 拉取更新
   ↓
5. 部署到生产环境
```

详细流程请查看 [MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md#从-staging-到-production-的工作流)

## 🛠️ 常用命令

### Docker 管理

```bash
# 启动所有服务
docker compose -f docker-compose-production.yml up -d

# 停止所有服务
docker compose -f docker-compose-production.yml down

# 查看服务状态
docker compose -f docker-compose-production.yml ps

# 查看日志
docker compose -f docker-compose-production.yml logs -f

# 重启服务
docker compose -f docker-compose-production.yml restart
```

### WordPress 管理

```bash
# 进入 WordPress 容器
docker exec -it lovemyfluffy_wordpress bash

# 使用 WP-CLI
docker exec lovemyfluffy_wordpress wp --info --allow-root

# 清除缓存
docker exec lovemyfluffy_wordpress wp cache flush --allow-root

# 更新 WordPress
docker exec lovemyfluffy_wordpress wp core update --allow-root

# 更新插件
docker exec lovemyfluffy_wordpress wp plugin update --all --allow-root
```

### 数据库管理

```bash
# 备份数据库
docker exec lovemyfluffy_mysql mysqldump -uwordpress -p lovemyfluffy > backup.sql

# 恢复数据库
docker exec -i lovemyfluffy_mysql mysql -uwordpress -p lovemyfluffy < backup.sql

# 进入 MySQL
docker exec -it lovemyfluffy_mysql mysql -uwordpress -p
```

## 🔐 安全建议

### 生产环境必做

- ✅ 使用强密码（20+ 字符）
- ✅ 关闭调试模式（`WORDPRESS_DEBUG=false`）
- ✅ 配置 SSL 证书
- ✅ 定期更新 WordPress、主题和插件
- ✅ 设置自动备份
- ✅ 安装安全插件（Wordfence）
- ✅ 限制登录尝试
- ✅ 使用防火墙

详细安全配置请查看 [MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md#安全建议)

## 📊 性能优化

### 推荐优化

1. **启用 Redis 缓存**
2. **安装图片优化插件**（EWWW Image Optimizer）
3. **配置 CDN**（Cloudflare）
4. **启用 Gzip 压缩**
5. **优化数据库**

详细优化步骤请查看 [MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md#性能优化)

## 🐛 故障排除

### 常见问题

| 问题 | 解决方案 |
|------|----------|
| 端口被占用 | 修改 `.env` 中的 `WORDPRESS_PORT` |
| Docker 无法启动 | `docker system prune -f` 清理后重启 |
| 主题导入失败 | 增加 PHP 内存限制，参考文档 |
| 图片无法显示 | 检查上传目录权限 |
| 数据库连接失败 | 检查 `.env` 中的数据库配置 |

详细故障排除请查看 [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md#常见问题)

## 📞 获取帮助

### 文档资源

- **快速开始**: [QUICK-START.md](QUICK-START.md)
- **主题配置**: [PETITO-THEME-SETUP.md](PETITO-THEME-SETUP.md)
- **生产部署**: [MAC-MINI-DEPLOYMENT.md](MAC-MINI-DEPLOYMENT.md)
- **开发指南**: [DEVELOPMENT.md](DEVELOPMENT.md)

### 主题支持

- **主题文档**: `wordpress/theme-files/Documentation/index.html`
- **演示站点**: http://bw-petito-demo4.bzotech.com/

### 技术支持

- **Docker 日志**: `docker compose logs -f`
- **WordPress 调试**: `wordpress/wp-content/debug.log`
- **健康检查**: `bash health-check.sh`

## 🎯 下一步

完成安装后，您可以：

1. ✅ 替换 Demo 内容为您自己的产品
2. ✅ 配置支付网关（Stripe, PayPal）
3. ✅ 设置运输选项和税率
4. ✅ 配置邮件服务（SMTP）
5. ✅ 优化 SEO 设置
6. ✅ 测试完整的购物流程
7. ✅ 配置域名和 SSL
8. ✅ 设置自动备份

## 📄 许可证

- **WordPress**: GPL v2 或更高
- **Petito Theme**: 商业许可证（已购买）
- **项目代码**: MIT License

## 🙏 致谢

- **Petito Theme** by BZOTech
- **WordPress** 社区
- **Docker** 团队

---

**版本**: 1.0.0  
**最后更新**: 2026-01-28  
**主题版本**: Petito v1.6.5  
**WordPress 版本**: 6.4+

**祝您使用愉快！** 🐾
