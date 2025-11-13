<!--
Sync Impact Report:
- Version change: [template] → 1.0.0
- New project: WordPress containerized deployment with testing
- Added principles: Docker-First, Documentation-Driven, Testing-Driven, MCP Integration, Progress Tracking
- Templates requiring updates: ✅ All templates compatible with new principles
- Follow-up TODOs: None
-->

# LoveMyFluffy WordPress Constitution

## Core Principles

### I. Docker-First Development
All services MUST be containerized using Docker. The WordPress site, database (MySQL), and PHP services MUST run in separate containers with proper service isolation. Port 8660 MUST be used for web access. Container orchestration via docker-compose is REQUIRED for local development and deployment.

### II. Documentation-Driven Development
All development decisions MUST be informed by latest official documentation using Context7 MCP tools. WordPress best practices, PHP configurations, and MySQL optimizations MUST reference current official sources. Code implementations MUST follow documented standards and security guidelines.

### III. Testing-Driven Quality Assurance
Browser testing using Playwright MCP is MANDATORY before deployment. All user workflows (installation, login, content creation, theme customization) MUST be validated through automated browser tests. Testing scenarios MUST cover responsive design and accessibility standards.

### IV. MCP Integration Requirements
Development workflow MUST utilize Model Context Protocol (MCP) tools:
- Context7 MCP for documentation lookup and best practices
- Playwright MCP for browser testing and debugging
- Progress-recorder subagent for development tracking

### V. Progress Tracking Discipline
All development progress MUST be recorded using the progress-recorder subagent. Key milestones, decisions, issues, and solutions MUST be documented in progress.md. Development workflow MUST be transparent and auditable through progress records.

## Technical Standards

### Container Architecture
- WordPress container with PHP-FPM
- MySQL 8.0+ database container with persistent volumes
- Nginx reverse proxy for web serving
- Docker networks for service communication
- Environment-based configuration management

### Security Requirements
- WordPress security best practices implementation
- Database credential management via Docker secrets
- Container user privilege restrictions
- Regular security updates via automated processes

## Development Workflow

### Implementation Process
1. Research phase using Context7 MCP for latest WordPress documentation
2. Progress recording via progress-recorder before major development steps
3. Docker container setup with proper service architecture
4. WordPress configuration following documented best practices
5. Browser testing via Playwright MCP for all user scenarios
6. Documentation updates reflecting implementation decisions

### Quality Gates
- All containers MUST build successfully
- WordPress installation MUST complete without errors
- Browser tests MUST pass all core functionality scenarios
- Progress documentation MUST be current and complete

## Governance

Constitution compliance is enforced through development workflow. All implementation decisions MUST align with principles. MCP tool usage is mandatory and non-negotiable. Progress tracking ensures accountability and knowledge preservation.

**Version**: 1.0.0 | **Ratified**: 2025-09-28 | **Last Amended**: 2025-09-28