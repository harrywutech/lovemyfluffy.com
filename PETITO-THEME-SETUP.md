# Petito Theme Setup Guide for LoveMyFluffy.com

本指南详细说明如何安装 Petito 主题并导入 Demo 4 内容，使您的网站看起来与演示站点完全一致。

## 目录

1. [环境准备](#环境准备)
2. [主题安装](#主题安装)
3. [Demo 4 导入](#demo-4-导入)
4. [配置优化](#配置优化)
5. [常见问题](#常见问题)

---

## 环境准备

### 系统要求

在开始之前，请确保您的环境满足以下要求：

- **Docker**: 已安装并运行
- **Docker Compose**: v2.0 或更高版本
- **磁盘空间**: 至少 5GB 可用空间
- **内存**: 建议 4GB 或以上

### PHP 配置要求

Petito 主题需要以下 PHP 配置（已在 Docker 配置中设置）：

```
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
post_max_size = 64M
upload_max_filesize = 64M
```

---

## 主题安装

### 方法 1：使用自动化脚本（推荐）

我们提供了一键安装脚本，可以自动完成主题和插件的安装：

```bash
# 1. 确保 Docker 环境正在运行
cd /path/to/lovemyfluffy.com
docker compose -f docker-compose-production.yml up -d

# 2. 等待服务启动（约 30 秒）
sleep 30

# 3. 运行安装脚本
bash install-petito-theme.sh
```

脚本会自动完成以下操作：

- ✅ 安装 Petito 主题（父主题和子主题）
- ✅ 激活子主题
- ✅ 安装 WooCommerce 插件
- ✅ 安装 Elementor 页面构建器
- ✅ 安装 Revolution Slider
- ✅ 配置 WordPress 基本设置

### 方法 2：手动安装

如果您希望手动安装，请按照以下步骤操作：

#### 步骤 1：访问 WordPress 管理后台

1. 在浏览器中打开：`http://localhost:8660/wp-admin`
2. 使用管理员账号登录

#### 步骤 2：安装主题

1. 进入 **外观 > 主题**
2. 点击 **添加新主题**
3. 点击 **上传主题**
4. 选择 `wordpress/theme-files/Theme/bw-petito.v1.6.5.zip`
5. 点击 **立即安装**
6. 安装完成后，重复步骤上传 `bw-petito-child.zip`
7. 激活 **bw-petito-child** 子主题

#### 步骤 3：安装必需插件

主题激活后，您会看到 **安装插件** 的提示：

1. 点击 **开始安装插件**
2. 选择所有必需插件：
   - WooCommerce
   - Elementor
   - Revolution Slider
   - Contact Form 7
   - Yoast SEO
   - 其他主题特定插件
3. 点击 **安装** 并应用
4. 安装完成后，选择所有插件并点击 **激活**

---

## Demo 4 导入

Demo 4 是 Petito 主题的宠物店演示版本，包含完整的页面、产品、分类和设置。

### 导入步骤

#### 步骤 1：访问导入页面

1. 登录 WordPress 管理后台
2. 进入 **Theme Options > Import Demo Content**（主题选项 > 导入演示内容）

#### 步骤 2：选择 Demo 4

在导入页面，您会看到多个演示版本：

- Demo 1: 默认版本
- Demo 2: 另一种布局
- Demo 3: 第三种风格
- **Demo 4: 宠物店版本** ⭐（选择这个）

#### 步骤 3：选择导入选项

Petito 提供三种导入选项：

1. **Import Now（完整导入）** - 推荐
   - 导入所有内容：页面、文章、产品、图片、设置
   - 时间：10-15 分钟
   - 适合：首次安装

2. **Import Without Media（不含媒体）**
   - 导入内容但不下载图片
   - 时间：3-5 分钟
   - 适合：测试或网络较慢时

3. **Import Media（仅媒体）**
   - 仅导入图片和媒体文件
   - 时间：5-8 分钟
   - 适合：补充导入

#### 步骤 4：开始导入

1. 选择 Demo 4
2. 点击 **Import Now** 按钮
3. 等待导入完成（**请勿关闭浏览器**）
4. 导入过程中会显示进度条

#### 步骤 5：验证导入

导入完成后，检查以下内容：

- ✅ 首页显示 Demo 4 的布局
- ✅ 产品分类已创建（Dog Food, Fish Food, Hamster Food, Pet's Toy, Pet's House）
- ✅ 示例产品已导入
- ✅ 页面和菜单已创建
- ✅ 轮播图（Revolution Slider）已导入

### 导入后配置

#### 1. 设置首页

如果首页未自动设置：

1. 进入 **设置 > 阅读**
2. 选择 **一个静态页面**
3. 首页选择：**Home - Demo 4**
4. 保存更改

#### 2. 配置菜单

1. 进入 **外观 > 菜单**
2. 选择 **Demo 4 Menu**
3. 在 **显示位置** 中勾选 **Primary Menu**
4. 保存菜单

#### 3. 配置 WooCommerce

1. 进入 **WooCommerce > 设置**
2. 配置以下页面：
   - 商店页面：Shop
   - 购物车页面：Cart
   - 结账页面：Checkout
   - 我的账户页面：My Account
3. 保存设置

#### 4. 配置小工具（Widgets）

1. 进入 **外观 > 小工具**
2. Demo 4 的小工具应该已经自动配置
3. 如果需要调整，可以在侧边栏中添加或删除小工具

---

## 配置优化

### 1. Logo 设置

更换为您自己的 Logo：

1. 进入 **外观 > 自定义 > 网站标识**
2. 上传您的 Logo 图片
3. 建议尺寸：200x60 像素（PNG 格式，透明背景）

### 2. 颜色和字体

调整主题颜色：

1. 进入 **Theme Options > Styling**（主题选项 > 样式）
2. 修改主色调（Primary Color）
3. 修改辅助色（Secondary Color）
4. 选择字体系列

### 3. Newsletter 弹窗

您在截图中看到的 Newsletter 弹窗可以这样配置：

1. 进入 **Theme Options > Newsletter Popup**
2. 启用弹窗
3. 设置显示延迟（建议 5 秒）
4. 配置弹窗内容和图片
5. 连接邮件服务（如 Mailchimp）

要禁用弹窗：
- 取消勾选 **Enable Newsletter Popup**

### 4. 顶部栏配置

配置顶部的 "Help & Contact" 和 "Order Tracking" 链接：

1. 进入 **Theme Options > Header**
2. 找到 **Top Bar** 设置
3. 配置左侧和右侧链接
4. 添加社交媒体图标

### 5. 产品分类图标

Demo 4 中的产品分类图标（Dog Food, Fish Food 等）：

1. 进入 **产品 > 分类**
2. 编辑每个分类
3. 上传分类图标（建议 100x100 像素）
4. 保存

### 6. 移动端底部栏

配置移动端的底部导航栏：

1. 进入 **Theme Options > Mobile**
2. 启用 **Mobile Footer Bar**
3. 配置图标和链接

---

## 常见问题

### Q1: 导入失败或中断怎么办？

**解决方案**：

1. 检查 PHP 配置是否满足要求
2. 增加 PHP 内存限制：
   ```bash
   docker exec lovemyfluffy_wordpress bash -c "echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/uploads.ini"
   docker compose restart wordpress
   ```
3. 重新尝试导入，选择 **Import Without Media** 先导入内容
4. 然后再选择 **Import Media** 补充图片

### Q2: 导入后页面显示不正确

**解决方案**：

1. 清除缓存：
   ```bash
   docker exec lovemyfluffy_wordpress wp cache flush --allow-root
   ```
2. 重新生成缩略图：
   ```bash
   docker exec lovemyfluffy_wordpress wp media regenerate --yes --allow-root
   ```
3. 重新保存固定链接：**设置 > 固定链接 > 保存更改**

### Q3: 图片无法显示

**解决方案**：

1. 检查上传目录权限：
   ```bash
   docker exec lovemyfluffy_wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads
   ```
2. 重新导入媒体：选择 **Import Media** 选项

### Q4: Revolution Slider 不工作

**解决方案**：

1. 确保 Revolution Slider 插件已激活
2. 进入 **Revolution Slider > Import Slider**
3. 从 `theme-files/assets/` 导入 Demo 4 的 slider 文件

### Q5: 如何移除 "Buy Now" 和 "Support" 按钮？

**解决方案**：

1. 进入 **Theme Options > General**
2. 找到 **Show Buy Now Button** 和 **Show Support Button**
3. 取消勾选并保存

### Q6: 如何更改货币符号？

**解决方案**：

1. 进入 **WooCommerce > 设置 > 常规**
2. 修改 **货币选项**
3. 选择您的货币和符号位置

### Q7: 网站速度慢怎么办？

**解决方案**：

1. 安装缓存插件（如 WP Super Cache）
2. 优化图片大小
3. 启用 CDN
4. 增加 Docker 容器内存：
   ```yaml
   # 在 docker-compose-production.yml 中添加
   wordpress:
     deploy:
       resources:
         limits:
           memory: 1G
   ```

---

## 下一步

完成主题安装和 Demo 4 导入后：

1. ✅ 替换 Demo 内容为您自己的产品和内容
2. ✅ 配置支付网关（Stripe, PayPal 等）
3. ✅ 设置运输选项
4. ✅ 配置税率
5. ✅ 测试购物流程
6. ✅ 配置 SSL 证书（生产环境）
7. ✅ 设置备份策略

## 技术支持

如果遇到问题：

1. 查看 WordPress 调试日志：
   ```bash
   docker exec lovemyfluffy_wordpress tail -f /var/www/html/wp-content/debug.log
   ```

2. 查看 Docker 日志：
   ```bash
   docker compose logs -f wordpress
   ```

3. 参考主题文档：`wordpress/theme-files/Documentation/index.html`

---

**祝您使用愉快！** 🐾
