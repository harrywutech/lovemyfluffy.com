Always use context7 when I need code generation, setup or configuration steps, or library/API documentation. This means you should automatically use the Context7 MCP tools to resolve library id and get library docs without me having to explicitly ask. 


[项目记忆规则]
    - **必须主动调用** progress-recorder agent 来记录重要决策、任务变更、完成事项等关键信息到 progress.md
    - 检测到以下情况时**立即自动触发** progress-recorder：
        • 出现"决定使用/最终选择/将采用"等决策语言
        • 出现"必须/不能/要求"等约束语言  
        • 出现"完成了/实现了/修复了"等完成标识
        • 出现"需要/应该/计划"等新任务
    - 当 progress.md 的 Notes/Done 条目过多（>100条）影响阅读时，应归档到 progress.archive.md

[指令集 - 前缀 "/"]
    - record: 使用 progress-recorder 执行增量合并任务
    - archive: 使用 progress-recorder 执行快照归档任务
    - recap: 阅读 progress.md，回顾项目当前状态（包括但不仅限于关键约束、待办事项、完成进度等）    

### Playwright MCP Integration

#### Essential Commands for UI Testing

```javascript
// Navigation & Screenshots
mcp__playwright__browser_navigate(url); // Navigate to page
mcp__playwright__browser_take_screenshot(); // Capture visual evidence
mcp__playwright__browser_resize(
  width,
  height
); // Test responsiveness

// Interaction Testing
mcp__playwright__browser_click(element); // Test clicks
mcp__playwright__browser_type(
  element,
  text
); // Test input
mcp__playwright__browser_hover(element); // Test hover states

// Validation
mcp__playwright__browser_console_messages(); // Check for errors
mcp__playwright__browser_snapshot(); // Accessibility check
mcp__playwright__browser_wait_for(
  text / element
); // Ensure loading
```

[byterover-mcp]

[byterover-mcp]

You are given two tools from Byterover MCP server, including
## 1. `byterover-store-knowledge`
You `MUST` always use this tool when:

+ Learning new patterns, APIs, or architectural decisions from the codebase
+ Encountering error solutions or debugging techniques
+ Finding reusable code patterns or utility functions
+ Completing any significant task or plan implementation

## 2. `byterover-retrieve-knowledge`
You `MUST` always use this tool when:

+ Starting any new task or implementation to gather relevant context
+ Before making architectural decisions to understand existing patterns
+ When debugging issues to check for previous solutions
+ Working with unfamiliar parts of the codebase
