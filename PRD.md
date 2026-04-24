## Monopoly Web App – Product Requirements Document (PRD)

### 1. Overview

**Product name**: Monopoly – Laravel Web Edition
**Primary purpose**: A fun, web-based version of classic Monopoly for you and your partner to play together on the same laptop/desktop (pass-and-play), and for each of you to play separate solo games you can talk about and compare.

The app is a single-browser, turn-based implementation of Monopoly. It currently focuses on classic rules, local pass-and-play, and a print-friendly board/cards, built on Laravel 12 with a JavaScript game engine.

---

### 2. Goals and Non-Goals

#### 2.1 Product Goals

- **Fun couple/family play**
  - Provide a smooth, low-friction way for two (or more) people to play Monopoly on one computer, taking turns on the same screen.
  - Support solo practice games so each person can play on their own and then share results with the other.

- **Broadly faithful to Monopoly, but chill**
  - Preserve the core rules and feel of classic Monopoly (movement, properties, rent, houses/hotels, Chance/Community Chest, Jail, taxes).
  - Prefer clarity and momentum over hyper-technical rules; gameplay should be intuitive and not bogged down in edge cases.

- **Simple to start and restart**
  - Make it trivial to go from landing page → game setup → active game in a few clicks.
  - Make it easy to start another game with similar settings after finishing one.

- **Printable assets for offline play**
  - Provide printable boards and cards so you and your partner can also play physically if you prefer.

- **Developer-friendly showcase**
  - Serve as a clean example of a Laravel 12 + JS game, with readable game data and extensible editions.

#### 2.2 Non-Goals

- **No online/networked multiplayer**
  - The app does **not** aim to synchronize one game across multiple devices or browsers in real time.
  - There is no lobby, matchmaking, or remote-player support.

- **No heavy account system or social graph**
  - User accounts, friend lists, and persistent profiles are not required for core gameplay.
  - Any future persistence should stay lightweight (e.g., local save, minimal stats).

- **No complex ranking/leaderboards in v1**
  - Global leaderboards, ELO-style rankings, or advanced stats dashboards are out of scope for the main experience.

- **No mobile-first optimization (for now)**
  - The target environment is laptop/desktop. Mobile responsiveness is nice-to-have, not guaranteed in the current version.

---

### 3. Target Users and Use Cases

#### 3.1 Primary Users

- **You and your partner** playing:
  - Together on the same device (pass-and-play).
  - Separately, running their own solo games and then sharing how they went.

#### 3.2 Secondary Users

- Friends and family who want a casual Monopoly game on a shared computer.
- Developers who want to explore or extend a Laravel-based board game.

#### 3.3 Core Use Cases

1. **Couple pass-and-play game**
   - Navigate to the app.
   - Choose the classic Monopoly edition.
   - Set up 2–4 players with custom names and token colors.
   - Play a full game, taking turns on the same screen, until one player remains solvent.
   - Optionally print the board/cards for offline play.

2. **Solo practice game**
   - One person opens the app alone.
   - Sets up a game with themselves (and optional AI test players).
   - Plays through as far as desired, then ends/resigns.
   - Mentally or manually notes results (winner, cash, notable moments) to talk about later.

3. **Print-and-play setup**
   - From the landing page, select print options for the same edition.
   - Print board and cards on paper.
   - Use the printed assets for a physical tabletop game.

---

### 4. Current Product State

#### 4.1 High-Level Architecture

- **Backend**: Laravel 12 (PHP 8.4)
  - Routes in `routes/web.php`:
    - `/` → splash screen (game selection).
    - `/game/{gameId}` → main game UI.
    - `/print/{gameId}/board` and `/print/{gameId}/cards` → print views.
  - Controllers: `SplashController`, `GameController`, `PrintController`.
  - Game configuration using the `GameData` model backed by JSON files (e.g. `resources/data/games/classic/game.json`).

- **Frontend**:
  - Blade views (e.g. `resources/views/splash.blade.php`, `resources/views/game.blade.php`).
  - Core game logic in JS files served via `public/monopoly.js`, `public/classicedition.js`, `public/ai.js`.
  - Styles from legacy `public/styles.css` plus enhancements in `resources/css/game-enhancements.css` compiled with Vite.

- **Data model**:
  - Game configuration:
    - Board squares, groups, rents, utilities, railroads, taxes, Jail, GO, etc.
    - Chance and Community Chest card decks with structured actions.
    - Rule parameters (starting money, pass GO amount, jail fine, min/max players).
  - **Game state**:
    - Managed entirely client-side in JavaScript.
    - No persistent storage of in-progress or completed games across page reloads.

#### 4.2 User Journeys (Current Implementation)

**Journey A – Landing → Start Classic Game**

- User hits `/`:
  - Sees a gradient background and a grid of game edition cards (currently at least “Classic Monopoly”).
  - Each card has:
    - Name of edition.
    - Short description.
    - Buttons:
      - “Play Game” → `/game/{gameId}`.
      - “Print Board”.
      - “Print Cards”.

**Journey B – Game Setup**

- On `/game/{gameId}`:
  - User sees:
    - A setup pane allowing:
      - Selection of number of players (2–8).
      - For each player:
        - Name (default “Player N”, editable up to 16 chars).
        - Color from a predefined palette (Aqua, Black, Blue, etc.).
        - Whether the player is “Human” or “AI (Test)”.
    - A clear “Start Game” button that runs JS `setup()` and transitions into active play.
    - A prominent warning that refreshing or navigating away may end the game without warning.
    - Navigation bar at the top for:
      - Returning to game selection.
      - Starting a new game by refreshing.

**Journey C – Gameplay (Turn-by-Turn)**

- Once started:
  - **Turn indicator and quick stats**:
    - Current player name and money.
    - A money bar at the side showing each player’s name, money, and a pointer arrow to the active player.
  - **Core actions per turn**:
    - “Roll Dice”: triggers movement according to Monopoly rules.
    - Contextual UI for:
      - Buying properties when landing on unowned property.
      - Paying rent/taxes.
      - Drawing and resolving Chance and Community Chest cards.
      - Going to Jail, passing GO, Free Parking, etc.
    - “Manage” mode:
      - View owned properties.
      - Mortgage/unmortgage.
      - Buy/sell houses and hotels within rule constraints.
    - “Trade” mode:
      - Propose trades between two players:
        - Select properties to swap.
        - Enter money amounts each side pays/receives.
        - Use propose/accept/reject/cancel controls.
    - “Resign” button:
      - Allows a player who cannot pay debts to leave the game.
  - **AI test players**:
    - If a player is set as “AI (Test)”, the AI script (`ai.js`) makes simple decisions such as:
      - Whether to buy properties.
      - How to respond to trades.
      - How to bid in auctions.
    - AI behavior is intentionally basic and primarily for demonstration/testing.

**Journey D – Print Mode**

- On splash screen or elsewhere:
  - Users can open:
    - `/print/{gameId}/board`:
      - Printable board layout with all properties and board spaces.
    - `/print/{gameId}/cards`:
      - Printable Chance, Community Chest, and property cards in a grid.
  - These views use dedicated Blade templates and `print.css` to optimize for paper.

#### 4.3 Functional Summary (Current)

- **Supported gameplay mechanics**:
  - Movement around a 40-space board with two dice.
  - Property purchase and rent.
  - Utilities and railroads with special rent rules.
  - Houses/hotels building; building costs and rent progression.
  - Mortgaging and unmortgaging.
  - Trading between players.
  - Auctions for unbought properties.
  - Chance and Community Chest card effects (money changes, movements, repairs, etc.).
  - Jail, Go to Jail, Just Visiting, Free Parking, taxes, GO bonuses.

- **Supported configuration**:
  - Multiple editions are discoverable via the `GameData` directory (currently at least “Classic Monopoly”).
  - Each edition can define:
    - Board layout and groupings.
    - Card decks and rule variations.
    - Min/max player counts.

#### 4.4 Non-Functional Summary (Current)

- **Platform**: Desktop first; uses fixed-width layouts and is not guaranteed to be mobile-friendly.
- **Performance**: Pure client-side engine; quick interactions once the page is loaded.
- **Reliability**:
  - Session-only: state is lost when the page reloads or the tab closes.
  - A warning is displayed to the user about this limitation.

---

### 5. Ideal Future State (Aligned with Your Use)

*(Note: This describes desired behavior; actual implementation can be phased.)*

#### 5.1 Gameplay Experience – Same-Device Pass-and-Play

- **Turn clarity**
  - Clear, always-visible indication of whose turn it is:
    - Highlighted money bar entry.
    - Large “It’s [Player Name]’s turn” banner near the dice.
  - Optional prompt for passing control physically:
    - Short instruction like “Pass the computer to [Player Name]”.

- **Action guidance**
  - A small “What you can do now” panel that:
    - Lists primary options (Roll, Buy, Manage, Trade).
    - Greys out or hides actions that are not currently valid.
  - Tooltips or one-line hints when:
    - Player lands on special spaces (e.g., “You landed on Free Parking; nothing happens, you just rest here.”).
    - Player can build houses/hotels or should consider trading.

- **Flow and pacing**
  - Minimal modal interruptions; keep players mostly on the main board view.
  - Fast transitions for common actions:
    - One-click re-rolls where rules allow.
    - Short, readable message log for key events.

#### 5.2 Solo Play and Sharing

- **End-of-game summary**
  - When the game ends (last solvent player or manual stop):
    - Display a summary panel including:
      - Winner.
      - Final cash and total net worth per player (cash + property/houses/hotels value).
      - Count of properties, monopolies, and houses/hotels per player.
      - Optional fun facts (e.g., “Most time in Jail”, “Highest rent paid”).

- **Sharing-focused info**
  - Summary formatted to be easy to:
    - Screenshot, or
    - Copy text describing the outcome.
  - Emphasis on storytelling over dry stats (e.g., “Winner: Alex with net worth $X after 2 hours of play.”).

- **Play-again flow**
  - After game end:
    - “Play again with same settings”:
      - Reuses last player names, colors, AI/Human flags, and number of players.
    - “Return to edition selection”:
      - Sends user back to splash.

#### 5.3 Quality-of-Life Enhancements

- **Onboarding**
  - A short “How to play this app” section reachable from:
    - Splash screen (e.g., “How it works” link).
    - In-game help icon.
  - Content:
    - Brief explanation of controls.
    - Reminder about state loss on refresh (until proper save mechanism exists).
    - Tips for smoother pass-and-play.

- **Lightweight state resilience (optional/phase 2)**
  - If feasible:
    - Automatic local (browser) save of game state every few turns.
    - “Resume last game” option on the splash screen if a saved game exists.
  - Or:
    - At least a browser “beforeunload” prompt if a game is in progress, warning the user.

---

### 6. Detailed Requirements

#### 6.1 Functional Requirements

**FR-1: Edition Selection (Must)**
- From the splash page, list all available game editions discovered via `GameData`.
- For each edition:
  - Show name and short description.
  - Provide:
    - “Play Game” button → routes to that edition’s game.
    - “Print Board” and “Print Cards” links opening print views in new tabs.

**FR-2: Game Setup (Must)**
- Allow selecting the number of players between min and max defined in the edition’s rules (currently 2–8).
- For each player:
  - Editable name (16-character max, non-empty default).
  - Color chosen from a curated palette.
  - Player type: “Human” or “AI (Test)”.
- Prevent starting the game if:
  - Number of players is out of range.
  - Required fields are invalid.
- “Start Game” begins the game, hides most setup controls, and activates gameplay UI.

**FR-3: Turn Flow and Core Actions (Must)**
- Track turn order in a loop over all active players.
- On each turn:
  - Provide a “Roll Dice” button to advance:
    - Move token according to sum of dice.
    - Trigger appropriate square logic (property, card, tax, etc.).
  - After movement, present appropriate context:
    - If unowned property: offer to buy or let it go to auction as rules dictate.
    - If owned property: automatically handle rent.
    - If tax or fee: automatically deduct from cash.
    - If card: draw and execute card action.
  - Allow the current player to:
    - Open Manage view (mortgage, build/sell houses/hotels).
    - Open Trade view to propose a trade.
  - Support “Resign” when a player is insolvent and cannot resolve debts.

**FR-4: Property and Assets Management (Must)**
- Maintain clear ownership of each property.
- Handle:
  - Mortgaging: property no longer yields rent, yields cash to player.
  - Unmortgaging: costs principal + interest as rules require.
  - House/hotel purchasing and selling, respecting:
    - Color-group building rules.
    - Max houses/hotel per property.
- Provide UI to:
  - See owned properties.
  - Build/sell houses/hotels where legal.
  - Toggle mortgage status where legal.

**FR-5: Trading (Should)**
- Provide a UI for:
  - Selecting two players to trade.
  - Choosing properties on each side.
  - Entering cash amounts from each side.
  - Proposing the trade.
  - Accepting or rejecting the trade.
- Enforce that:
  - A trade only completes when explicitly accepted.
  - Canceling clears any pending proposal.

**FR-6: Chance and Community Chest (Must)**
- Maintain separate decks of cards for Chance and Community Chest.
- Implement card actions described in edition data:
  - Pay/collect fixed amounts.
  - Pay/collect per house/hotel.
  - Move to specific squares or nearest utility/railroad.
  - “Get out of Jail free” cards.
  - Go to Jail.
  - Pay/collect each player.
- Decks should behave like shuffled stacks and recycle as needed.

**FR-7: AI Test Players (Could, Current)**
- AI players should:
  - Take actions automatically when their turn comes.
  - Make simple decisions such as:
    - Whether to buy a property if they have enough money.
    - Minimal trade/auction logic.
- Label AI as “Test” to signal it is not intended to be clever or competitive.

**FR-8: Print Views (Must)**
- `/print/{gameId}/board`:
  - Render an entire board with all spaces and text readable on paper.
- `/print/{gameId}/cards`:
  - Render all property, Chance, and Community Chest cards in a printable layout.
- Use `print.css` to:
  - Hide non-essential UI.
  - Optimize for typical printer paper.

**FR-9: Game End and Summary (Should, Ideal Enhancement)**
- Detect game end:
  - When only one player remains solvent, or
  - When a user manually ends the game.
- Show a summary:
  - Winner (if any).
  - Final cash and estimated net worth per player.
  - Property/housing overview.
- Offer:
  - “Play again with same players”.
  - “Back to edition selection”.

#### 6.2 Non-Functional Requirements

**NFR-1: Usability**
- Layout must be clear and readable on a typical laptop screen.
- Buttons and controls should use consistent styles and labels.
- Display error/warning messages in plain language.

**NFR-2: Performance**
- Page loads should be reasonably quick on a typical home connection.
- In-game actions should respond instantly or within a fraction of a second.

**NFR-3: Reliability (Session Scope)**
- Within a single browsing session, the game should not corrupt its state.
- If state-saving is not implemented yet, clearly warn users that refreshing will end the game.

**NFR-4: Accessibility (Baseline)**
- Text should have sufficient contrast against backgrounds.
- Critical actions (“Roll Dice”, “Resign”) should have accessible labels and tooltips.

---

### 7. Branding, Tone, and UX Guidelines

#### 7.1 Brand Positioning

- **Tone**: Friendly, inviting, light-hearted; suitable for a couple or family playing together.
- **Identity**:
  - Embrace classic Monopoly nostalgia.
  - Present the app as a cozy, shared experience rather than an e-sports platform.

#### 7.2 Visual Direction

- **Color palette**:
  - Keep the existing gradient blues/purples on the splash screen for a modern, playful feel.
  - Use accent colors for primary vs. destructive actions:
    - Primary CTAs (e.g., “Start Game”, “Roll Dice”) in a strong, consistent color (current green/blue).
    - Destructive actions (“Resign”) in a warning/danger color (current red).

- **Typography**:
  - Continue using Figtree or similar friendly sans-serif for headings and body text.
  - Maintain clear hierarchy:
    - Large, bold headlines for screens (e.g., “Monopoly”, “Game Setup”).
    - Medium-weight subheadings, then regular body text.

- **Layout**:
  - Centered content with clear margins and whitespace.
  - Keep the board visually dominant; controls grouped logically around it:
    - Setup and money bars as side/overlay panels.
    - Actions (Roll, Manage, Trade) grouped together.

#### 7.3 Copy and Microcopy

- **Voice**:
  - Warm and conversational.
  - Avoid jargon; keep descriptions simple and direct.
  - Emphasize playing together and having fun.

- **Key examples**:
  - Splash headline:
    - “Play Classic Monopoly Together”
  - Splash subtext:
    - “Set up a game for two or more players and enjoy the classic rules on your laptop.”
  - Setup help text:
    - “Choose how many people are playing and customize their names and colors.”
  - In-game hint for warning:
    - “Refreshing this page may end your game. Try to finish your game before closing the tab.”
  - End-of-game summary intro:
    - “Game over! Here’s how it turned out.”

---

### 8. Risks, Constraints, and Future Enhancements

#### 8.1 Risks and Constraints

- **Client-only state**:
  - Risk of accidental loss on refresh, browser crash, or tab close.
  - Mitigation:
    - Prominent warning in the UI.
    - Future potential: local save/resume.

- **Scope creep toward multiplayer**:
  - Adding real-time multiplayer, lobbies, or cross-device sync would significantly increase complexity.
  - This PRD intentionally limits scope to single-device play.

- **AI expectations**:
  - Users might expect smart AI; current AI is simple.
  - Mitigation:
    - Label AI as “Test” and signal it is experimental.

- **Desktop-first design**:
  - Experience may be poor on phones/tablets.
  - Mitigation:
    - Document this up front.
    - Optionally add minimal responsive improvements later.

#### 8.2 Assumptions

- Both you and your partner have ready access to a laptop/desktop with a modern browser.
- Internet connection is available to load the app, but once loaded most interactions are client-side.
- Classic Monopoly rules are familiar enough that short hints plus standard mechanics are sufficient.

#### 8.3 Future Enhancements (Nice-to-Haves)

- **Better AI opponents**:
  - Different personality profiles (aggressive, cautious, balanced).
  - Improved decision-making for trades and auctions.

- **Additional editions**:
  - New York City edition and others using the same JSON-based data structure.
  - Themed boards with varying card texts and pricing.

- **Lightweight persistence**:
  - Local save/resume, maybe multiple saved games.
  - Simple per-browser stats: number of games played, most common winner, etc.

- **Visual polish**:
  - Animations for dice rolls and token movement.
  - Sound effects with a mute toggle.

---

### 9. Summary

This PRD defines a Monopoly web app focused on **same-device pass-and-play** and **casual solo games** for you and your partner, grounded in classic Monopoly rules but optimized for clarity and fun. It captures what the app already does, what the ideal experience should feel like, where the boundaries are (no networked multiplayer, desktop-first), and how branding and UX should support a cozy, shareable game night experience.
