# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel-based conference website for PHP Tek 2026, built with:
- **Laravel 12.x** with **Livewire** for dynamic components
- **Livewire Volt** for component-based views
- **Livewire Flux** for UI components
- **Tailwind CSS v4** for styling
- **Alpine.js** for client-side interactivity
- **SQLite** database (development)
- **Vite** for asset compilation
- **Pest** for testing

## Common Commands

### Development
```bash
# Start development server (runs all services concurrently)
composer dev

# Individual services
php artisan serve          # Laravel development server
php artisan queue:listen   # Queue worker  
php artisan pail          # Log viewer
npm run dev               # Vite development server

# Database operations
php artisan migrate        # Run migrations
php artisan db:seed       # Seed database
php artisan migrate:fresh --seed  # Fresh database with seed data
```

### Testing
```bash
# Run all tests
composer test
# OR
php artisan test

# Run specific test files
php artisan test --filter=ConferenceModelTest
php artisan test tests/Feature/ConferenceModelTest.php

# Run tests with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Laravel Pint (code formatting)
./vendor/bin/pint

# Clear caches
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Asset Compilation
```bash
npm run dev    # Development build with hot reload
npm run build  # Production build
```

## Architecture & Key Components

### Database Schema
- **conferences** table: Main conference data with UUID, name, venue details, and date ranges
- **users** table: Standard Laravel authentication
- Built-in caching and job queue support

### Models
- **Conference** (`app/Models/Conference.php`): Core conference model with date formatting methods
  - `getFormattedDateRange()`: Returns formatted date ranges like "May 19th - 21st, 2026"
  - `getDurationInDays()`: Calculates conference duration
  - `isOngoing()`: Checks if conference is currently active

### Routes & Views
- **Single Page Application**: Main route (`/`) renders `single.blade.php` with conference data
- **Authentication**: Standard Laravel Breeze-style auth routes in `routes/auth.php`
- **Settings**: Livewire Volt components for user profile, password, and appearance settings

### Frontend Architecture
- **Single Page Design**: The main view is in `resources/views/single.blade.php`
- **Tailwind CSS v4**: Custom CSS variables for theming (light/dark mode)
- **Alpine.js**: Used for interactive components (mobile menu, theme toggle, tabs)
- **Dark Mode**: Implemented with Alpine.js and localStorage persistence

### Configuration
- **Conference Settings**: Custom config in `config/tek.php` with UUID and timezone
- **Environment Variables**: `CONFERENCE_UUID` and `CONFERENCE_TIMEZONE` for conference-specific settings

## Testing Structure

Tests are organized with **Pest PHP**:
- `tests/Feature/`: Feature tests including Conference model tests
- `tests/Unit/`: Unit tests
- Key test files:
  - `ConferenceModelTest.php`: Tests conference model functionality
  - `DashboardTest.php`: Tests dashboard functionality
  - Auth tests in `tests/Feature/Auth/`

## Development Notes

### Conference Data
- Conference information is stored in the database and retrieved via `Conference::first()`
- The Conference model handles date formatting and business logic
- Dates are stored as datetime and cast to Carbon instances

### Asset Management
- CSS and JS are compiled with Vite
- Tailwind CSS v4 is used with custom color variables
- Alpine.js is loaded from CDN in the main template

### Authentication
- Uses Laravel Breeze-style authentication
- Livewire components for auth forms
- Settings pages for user profile management

## Key Files to Understand

- `routes/web.php`: Main routing logic
- `app/Models/Conference.php`: Conference business logic
- `resources/views/single.blade.php`: Main single-page application view
- `config/tek.php`: Conference-specific configuration
- `composer.json`: Development scripts and dependencies
- `database/migrations/2025_06_02_214425_create_conferences_table.php`: Conference schema
## Development Permissions

Claude has full permission to:
- **Edit any existing files** without asking for permission first
- **Create new files and directories** as needed for implementation
- **Run migrations and seeders** to update database structure
- **Make structural changes** to improve code organization
- **Create new components, models, controllers** as required
- **Update configuration files** and environment settings
- **Modify database schemas** through migrations
- **Add new routes, views, and assets** as needed

**Note**: Claude will still explain what changes are being made and why, but can proceed with implementation immediately without waiting for approval on each file modification.

## Coding Standards
When working on this Laravel/PHP project, first read the coding guidelines at @laravel-php-guidelines.md
