---
name: frontend-design
description: Design guidance for building distinctive, production-ready web interfaces. Use when creating or restyling components, pages, or full frontends, or when output starts to look like generic AI design.
---

# Frontend Design

Generic AI frontends share a look. Rounded cards on a white canvas, a purple-to-blue gradient, Inter everywhere, and evenly weighted sections with nothing to lead the eye. This skill exists to stop that outcome before the first line of CSS.

## Process

Work through these in order on any new build or restyle.

### 1. Commit to a direction

Name the aesthetic before writing code. Editorial, industrial, warm technical, brutalist, retro terminal, luxury minimal. Pick one and let it drive every later choice. If the user gave a brand or a reference, extract its direction instead of inventing one.

### 2. Typography carries the design

Choose one display face and one body face, and let them contrast. Set a type scale and hold to it. Default system stacks and Inter for everything are the fastest way back to generic.

### 3. Space on a system

Pick a base unit and derive every padding, margin, and gap from it. Arbitrary values read as noise. Generous spacing that breaks evenly on purpose reads as designed.

### 4. Color with restraint

One dominant neutral family, one accent doing real work, and semantic colors only where state demands them. No gradient unless the direction calls for one.

### 5. One memorable element

Every strong interface has a single thing you remember. An oversized headline, a hard grid, an unexpected hover. Build one deliberately. More than one competes with itself.

## Rules

- Never open with a template look. If the first draft could be any SaaS landing page, restart at step 1.
- Real content over placeholder. Lorem ipsum hides bad hierarchy.
- Interactive states are part of the design. Hover, focus, and active get the same care as the rest state.
- Accessibility is a direction constraint from step 1, not a pass at the end. Contrast and focus order shape the design.
- Motion is seasoning. One well-placed transition beats ten animated entrances.

## Boundaries

This skill shapes decisions. It does not generate image assets, import Figma files, or override a documented design system. When a design system exists, defer to it and apply this guidance only where the system is silent.
