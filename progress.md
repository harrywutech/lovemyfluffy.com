# Project: lovemyfluffy.com
_Last updated: 2025-09-28_

## Pinned（仅高置信"必须遵守"写入；受保护不可修订）
- 项目使用 Git 版本控制管理
- 主分支为 master，远程分支为 main
- 必须采用 Docker-First Development（容器化服务，端口 8660）
- 必须集成 Context7 MCP 用于文档驱动开发
- 必须使用 Playwright MCP 进行测试驱动质量保证
- 必须使用 progress-recorder 进行进度跟踪
- 容器架构必须使用：WordPress + MySQL + Nginx

## Decisions（按时间顺序追加，历史不可改）
- 2025-09-28: 确定项目名称为 lovemyfluffy.com
- 2025-09-28: 决定使用基础配置文件进行项目初始化（.gitignore, AGENTS.md, CLAUDE.md）
- 2025-09-28: 创建 LoveMyFluffy WordPress Constitution v1.0.0，确立五大核心原则：Docker-First Development、Documentation-Driven Development、Testing-Driven Quality Assurance、MCP Integration Requirements、Progress Tracking Discipline（理由：为项目建立统一的开发标准和技术架构框架）
- 2025-09-28: 决定使用 WordPress 6.4+ 和 PHP 8.2+ 以获得现代性能
- 2025-09-28: 决定采用 WooCommerce 进行电商功能，Yoast SEO 进行优化，Stripe 进行支付集成
- 2025-09-28: 决定产品分类采用宠物特定类别（狗、猫、鸟、鱼、小型宠物）

## TODO（权威待办清单）

## In Progress

## Done（最近完成的放前面）
- 2025-09-28: [#6] 完成实施任务生成（feature: 001-lovemyfluffy-com-ecommerce, evidence: tasks.md 包含 63 项详细实施任务，涵盖基础设施、WordPress配置、TDD测试、主题定制、安全性能等完整实施路径）
- 2025-09-28: [#5] 完成 WordPress 电商实施计划（feature: 001-lovemyfluffy-com-ecommerce, branch: 001-lovemyfluffy-com-ecommerce, evidence: plan.md, research.md, data-model.md, contracts/woocommerce-api.yml, contracts/stripe-webhooks.yml, quickstart.md, CLAUDE.md 已创建/更新）
- 2025-09-28: [#4] 创建项目宪法 LoveMyFluffy WordPress Constitution v1.0.0（evidence: .specify/memory/constitution.md）
- 2025-09-28: [#1] 项目初始化完成（evidence: 成功提交并推送配置文件到远程 main 分支）
- 2025-09-28: [#2] 创建项目配置文件（evidence: .gitignore, AGENTS.md, CLAUDE.md 已提交）
- 2025-09-28: [#3] 设置 Git 仓库（evidence: 当前分支 master，已关联远程仓库）

## Risks & Assumptions
- Assumption: 项目将继续使用当前的分支策略（master 本地，main 远程）（Confidence: High）

## Notes（简要要点）
- 2025-09-28: 实施任务生成完成：63项任务包含完整TDD方法、并行执行标记[P]、MCP集成（Context7+Playwright）、宪法合规验证
- 2025-09-28: 项目宪法制定完成，确立了 Docker-First、文档驱动、测试驱动等五大核心开发原则
- 2025-09-28: 项目已使用基础配置完成初始化
- 2025-09-28: 当前工作在 master 分支，推送到远程 main 分支
- 2025-09-28: progress-recorder agent 功能测试成功
- 2025-09-28: WordPress 电商实施计划阶段已完成，准备生成后续任务
- 2025-09-28: 已完成 Docker-first 架构、WordPress/PHP 版本、WooCommerce/Yoast/Stripe 集成等关键技术决策

## Context Index（轻量索引）
- plan.md
- research.md
- data-model.md
- contracts/woocommerce-api.yml
- contracts/stripe-webhooks.yml
- quickstart.md
- CLAUDE.md
- tasks.md