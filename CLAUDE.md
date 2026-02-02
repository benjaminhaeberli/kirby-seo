# CLAUDE.md

## Project

Kirby SEO – Minimal SEO plugin for Kirby CMS generating meta, Open Graph and Twitter Card tags.

## Commands

```bash
composer install          # Install dependencies
composer test             # Run all checks (rector, pint, phpstan, pest)
composer test:unit        # Pest unit tests only
composer test:types       # PHPStan analysis
composer lint             # Fix code style (Pint, PSR-12)
composer refacto          # Run Rector refactoring
composer coverage         # Tests with coverage report
```

## Structure

- `src/` – Plugin core (`KirbySeo` class, interface, bootstrap)
- `snippets/meta.php` – HTML meta tags rendering
- `blueprints/fields/` – Kirby Panel field definitions (seo.yml, site.yml)
- `translations/` – i18n (en, fr)
- `tests/` – Pest tests

## Conventions

- PHP 8.2+ runtime, PHP 8.3+ for dev tools
- Strict types in all PHP files
- PSR-12 code style (Laravel Pint)
- PHPStan level 6
- All Kirby field names prefixed with `kirbyseo`
- Tests create isolated Kirby `App` instances, cleaned up in `afterEach`
