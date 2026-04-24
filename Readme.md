# 🎲 Monopoly Game - Laravel Edition

A modern web-based implementation of the classic Monopoly board game built with Laravel 12 and enhanced with Laravel Boost for AI-assisted development.

## 🚀 Features

- **Complete Monopoly Gameplay**: Full implementation of classic Monopoly rules
- **Laravel 12**: Built on the latest Laravel framework with streamlined architecture
- **Laravel Boost Integration**: Enhanced AI-assisted development with MCP server and comprehensive coding guidelines
- **Modern Frontend**: Built with Tailwind CSS and Vite for fast, responsive UI
- **Database Persistence**: SQLite database with Eloquent ORM for game state management
- **Real-time UI**: Dynamic game board updates and player interactions

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.4)
- **Frontend**: Blade templates, Tailwind CSS, JavaScript
- **Database**: SQLite
- **Build Tool**: Vite
- **Development**: Laravel Boost (MCP server for AI assistance)

## 📦 Laravel Boost Setup

This project is configured with Laravel Boost, providing:

- **MCP Server**: Model Context Protocol server for enhanced AI assistance
- **Coding Guidelines**: Comprehensive Laravel-specific development rules
- **AI Tools**: Specialized tools for Laravel development workflows
- **Documentation API**: Access to Laravel ecosystem documentation

### Boost Features Available

- `search-docs` - Search Laravel documentation and packages
- `list-artisan-commands` - Get available Artisan commands with parameters
- `get-absolute-url` - Generate proper application URLs
- `tinker` - Execute PHP code for debugging
- `database-query` - Read database without affecting models
- `browser-logs` - Access browser console logs

## 🏁 Getting Started

### Prerequisites

- PHP 8.4 or higher
- Composer
- Node.js & npm
- SQLite (included with PHP)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd monopoly
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🎮 How to Play

1. Navigate to the application in your browser
2. Select your game edition from the splash screen
3. Add players and start the game
4. Follow classic Monopoly rules:
   - Roll dice to move around the board
   - Buy properties when landing on unowned spaces
   - Pay rent to other players when landing on their properties
   - Collect $200 when passing GO
   - Go to jail when landing on "Go to Jail"
   - Win by being the last player with money when others go bankrupt

## 🏗️ Development

### Laravel Boost Commands

```bash
# Install/update Boost (already done)
php artisan boost:install

# Start MCP server manually (usually auto-started)
php artisan boost:mcp
```

### Development Scripts

```bash
# Start development servers concurrently
composer run dev

# Run tests
php artisan test

# Code formatting
vendor/bin/pint

# Static analysis
vendor/bin/phpstan analyse
```

### AI-Assisted Development

This project is optimized for Cursor AI agents with Laravel Boost. The following guidelines are automatically applied:

- **Foundation Rules**: Core Laravel development practices
- **PHP Rules**: Modern PHP 8.4+ syntax and best practices
- **Laravel Core Rules**: Framework-specific patterns and conventions
- **Laravel V12 Rules**: Version-specific features and changes
- **Pint Rules**: Code formatting standards
- **PHPUnit Rules**: Testing best practices

## 📁 Project Structure

```
├── app/                    # Laravel application code
│   ├── Http/Controllers/   # HTTP controllers
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── resources/             # Frontend assets and views
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   ├── views/            # Blade templates
│   └── data/games/       # Game data files
├── routes/                # Route definitions
├── database/              # Migrations and seeders
├── public/                # Public assets and game files
├── storage/               # File storage
├── tests/                 # Test files
├── .cursor/               # Cursor AI configuration
│   ├── mcp.json          # MCP server configuration
│   └── rules/            # AI coding guidelines
├── AGENTS.md              # AI agent guidelines
└── boost.json             # Boost configuration
```

## 🤝 Contributing

This project uses Laravel Boost for AI-assisted development. When contributing:

1. Follow the established coding guidelines in `AGENTS.md`
2. Use `vendor/bin/pint` to format code before committing
3. Run tests with `php artisan test`
4. Ensure all changes work with the existing Monopoly game logic

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
