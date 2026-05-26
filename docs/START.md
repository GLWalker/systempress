# SystemPress Project Documentation & Coding Standards

Internal Contributor Reference — Coding Standards

Purpose:
Provide a concise, neutral, reusable description of preferred coding practices for JavaScript, PHP, and CSS across all projects.

────────────────────────────────────────
JavaScript Coding Standards
────────────────────────────────────────

1. Style & Structure
- Use `var` for variable declarations (consistency, predictable scoping, works cleanly in inline/embedded environments).
- Prefer simple, direct code instead of abstractions, frameworks, or over-engineering.
- Code should run cleanly inline without wrappers unless absolutely required.
- Wrapper patterns (IIFE, modules, classes) only used when logically necessary, not by default.
- Keep function and variable names short, clear, and purpose-driven.

2. Namespacing
- Avoid polluting the global scope.
- Shared utilities should be namespaced, e.g.:
  window.SP = window.SP || {};
  SP.doSomething = function() {};
- Namespaces should be lightweight, not full-blown frameworks.

3. Event Handling
- Add event listeners directly, not through abstraction layers.
- Avoid unnecessary global listeners.
- Use passive listeners when appropriate, but not blindly.

4. DOM Manipulation
- Prefer direct DOM and attribute manipulation:
  element.classList.add(...)
  element.setAttribute(...)
- Keep logic plain and performant.

5. Utility Functions
- When a pattern is reused multiple times across a project, promote it to:
  - a namespaced utility
  - or a shared helper file
- Keep utilities generic, not bound to specific plugin logic.

6. Dependencies
- Minimal dependencies.
- Use jQuery only when interacting with WordPress admin or where it is naturally present.
- No reliance on heavy frameworks or unnecessary libraries.

7. Performance & Readability
- Prefer tight, optimized loops.
- Avoid repeated DOM queries — store references.
- Short, clean logic blocks.
- Avoid bloated logic or deeply nested functions.

────────────────────────────────────────
PHP Coding Standards
────────────────────────────────────────

1. General Style
- Concise, readable logic.
- Early returns to reduce nesting:
  if (!condition) return;
- Functions and methods should do one clear job.

2. Structure & Organization
- Use classes when:
  - grouping related functionality
  - managing encapsulated systems
  - needing static helper containers
- Use standalone functions when:
  - the logic is simple
  - the code is utility-oriented

3. Namespacing / Prefixing
- All functions/classes should be prefixed or namespaced to prevent collisions.
- Prefixes should be short and recognizable, e.g.:
  GW_, SP_, Tools_, etc.

4. Inputs & Outputs
- Always sanity-check and sanitize input.
- Escape all output going to HTML.
- Use strict PHP 8+ features where they help maintain clarity (nullable types, match, etc.).

5. Maintainability Over Cleverness
- Code should be obvious to read.
- Avoid magic tricks, over-abstracted patterns, or deeply nested logic.
- Prefer clarity over excessive DRY if it harms readability.

6. Reusable Utility Logic
- When logic repeats across multiple areas, pull it into a:
  - shared class (e.g., Utility)
  - helper file
  - namespaced function library
- Ensure utilities are generic, not tied to one plugin’s internal structure.

7. Compatibility
- WordPress standards respected where they matter:
  - capability checks
  - nonce checks
  - escaping & sanitizing
- Keep file structures clean and organized.

────────────────────────────────────────
CSS Coding Standards
────────────────────────────────────────

1. Simplicity
- Clean, minimal selectors.
- Avoid excessive nesting.
- Avoid unnecessary specificity.

2. Utility-Oriented Thinking
- Prefer short, purposeful classes over long semantic ones.
- Reuse layout utilities (flex, grid, spacing) rather than rewriting each time.

3. Pixel-Level Precision
- Visual perfection is key — spacing, alignment, sizing must be intentional.
- Willing to spend the extra time to get everything exact.

4. Minimal Framework Usage
- Only load portions of CSS frameworks (like Bootstrap) as needed.
- Lean, selective imports based on actual class usage.

5. Color Systems
- Prefer dynamic, programmatically generated colors.
- Colors should always maintain WCAG-compliant contrast.
- Text contrast adjustments handled in PHP or JS helpers.

6. Responsiveness
- Responsive behavior built where needed — not as an afterthought.
- Keep media queries simple and minimal.

7. Maintainability
- Avoid one-off, single-use classes when possible.
- CSS should be easy for another contributor to read and extend.

────────────────────────────────────────
Cross-Language Philosophy
(Applies to JS, PHP, and CSS equally)
────────────────────────────────────────

1. Performance first
Lean, optimized, efficient code.

2. Structural discipline
Code should always be predictable and organized.

3. Cleanliness
Readable, concise, and free of bloat.

4. Purpose-driven
Everything exists for a reason — no dead code, no excessive abstractions.

5. Utility bias
When something repeats, turn it into a reusable tool.

6. Control
Direct manipulation > layers of abstraction.

7. Maintainability
Future contributors must be able to understand the code instantly.

8. Professional craftsmanship
Strong, exact, efficient, and clean.
