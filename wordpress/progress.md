# Project: LoveMyFluffy WordPress E-commerce
_Last updated: 2025-09-28_

## Pinned（仅高置信"必须遵守"写入；受保护不可修订）
- 必须采用 Docker-First 架构确保环境一致性
- 必须遵循测试驱动开发（TDD）方法
- 必须集成 WooCommerce 用于电商功能
- 必须支持 Stripe 支付处理
- 必须优化宠物类别和产品展示

## Decisions（按时间顺序追加，历史不可改）
- 2025-09-28: 决定使用 PHP 8.2+ 作为 WordPress 运行环境（理由：性能和安全优势）
- 2025-09-28: 决定采用 Nginx 作为反向代理（理由：高性能和安全功能）
- 2025-09-28: 决定使用 Playwright 进行 API 合约测试（理由：全面的测试能力和 MCP 集成）
- 2025-09-28: 决定在 8660 端口运行开发环境（理由：避免与其他服务冲突）

## TODO（权威待办清单）
- [P0][OPEN][#1] 实施阶段 3.4 浏览器集成测试（E2E 测试）（Context：feature-001-lovemyfluffy-com-ecommerce）
- [P1][OPEN][#2] 配置生产环境部署策略（Context：从 docker-compose 迁移到生产级容器编排）
- [P1][OPEN][#3] 实施生产环境秘密管理（Context：数据库凭据、API 密钥安全管理）
- [P2][OPEN][#4] 建立 CI/CD 管道（Context：自动化测试、构建和部署）

## In Progress
- 暂无进行中的任务

## Done（最近完成的放前面）
- 2025-09-28: [#T020] 产品分类 API 测试（宠物特定结构）（evidence：Playwright 测试套件）
- 2025-09-28: [#T019] Stripe webhook 合约测试（支付处理）（evidence：contract tests）
- 2025-09-28: [#T018] WooCommerce 订单 API 合约测试（evidence：API 测试文件）
- 2025-09-28: [#T017] WooCommerce 客户 API 合约测试（evidence：API 测试文件）
- 2025-09-28: [#T016] WooCommerce 产品 API 合约测试（GET/POST）（evidence：API 测试文件）
- 2025-09-28: [#T015] Playwright 配置（全面测试）（evidence：测试配置文件）
- 2025-09-28: [#T014] 宠物分类样式和 schema 优化（evidence：主题文件）
- 2025-09-28: [#T013] 头部、底部和首页模板（evidence：主题模板文件）
- 2025-09-28: [#T012] 主题 functions.php（WooCommerce 集成和宠物特定功能）（evidence：functions.php）
- 2025-09-28: [#T011] 自定义 LoveMyFluffy 主题（宠物焦点设计）（evidence：主题目录）
- 2025-09-28: [#T010] 插件安装说明（WooCommerce、Yoast SEO、Stripe）（evidence：安装文档）
- 2025-09-28: [#T009] 完整的 WordPress 目录结构搭建（evidence：项目目录结构）
- 2025-09-28: [#T008] WordPress wp-config.php（数据库连接和安全密钥）（evidence：wp-config.php）
- 2025-09-28: [#T007] 完善的 .gitignore（安全和清理）（evidence：.gitignore 文件）
- 2025-09-28: [#T006] MySQL 初始化脚本（性能调优）（evidence：database/ 目录）
- 2025-09-28: [#T005] Nginx Dockerfile（反向代理和安全功能）（evidence：nginx/Dockerfile）
- 2025-09-28: [#T004] WordPress Dockerfile（PHP 8.2+ 和优化配置）（evidence：wordpress/Dockerfile）
- 2025-09-28: [#T003] Docker Compose 配置（服务运行在 8660 端口）（evidence：docker-compose.yml）
- 2025-09-28: [#T002] 环境配置（.env）包含 WordPress、MySQL、Stripe 设置（evidence：.env.example）
- 2025-09-28: [#T001] Docker 项目结构（wordpress/、database/、nginx/ 目录）（evidence：项目目录结构）

## Risks & Assumptions
- Risk：生产环境秘密管理尚未实施（Mitigation：计划使用云服务提供商的秘密管理服务）
- Risk：当前仅支持开发环境部署（Mitigation：下一阶段实施生产级容器编排）
- Assumption：插件版本兼容性（Confidence：Med）
- Assumption：Stripe 测试环境可充分模拟生产场景（Confidence：High）

## Notes（简要要点）
- 2025-09-28: 重大里程碑：完成阶段 3.1-3.3（基础设施、WordPress 配置、合约测试）
- 2025-09-28: 所有测试采用 TDD 方法，初始为失败状态
- 2025-09-28: 项目现已具备完整容器化架构，可通过 docker-compose up 启动
- 2025-09-28: 符合项目宪法：Docker 优先、文档驱动、测试驱动

## Context Index（轻量索引）
- Feature: 001-lovemyfluffy-com-ecommerce
- Repository: /Users/MAC/Sites/lovemyfluffy.com/wordpress
- Next Phase: 3.4 Browser Integration Tests (E2E testing)