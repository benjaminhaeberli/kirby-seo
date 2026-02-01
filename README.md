<p align="center">
    <img src="./logo.svg" width="256px" alt="Logo of Kirby SEO"></br>
    Minimal SEO plugin for Kirby CMS
</p>

<p align="center">
    <a href="https://github.com/benjaminhaeberli/kirby-seo/actions"><img src="https://github.com/benjaminhaeberli/kirby-seo/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/benjaminhaeberli/kirby-seo"><img src="https://img.shields.io/packagist/dt/benjaminhaeberli/kirby-seo" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/benjaminhaeberli/kirby-seo"><img src="https://img.shields.io/github/v/release/benjaminhaeberli/kirby-seo" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/benjaminhaeberli/kirby-seo"><img src="https://img.shields.io/github/license/benjaminhaeberli/kirby-seo" alt="License"></a>
</p>

## Features

- Meta tags (title, description, keywords, robots, canonical URL)
- Open Graph tags (title, type, site name, URL, image, description, locale)
- Twitter Card tags (title, card, site, creator, image, description)
- Automatic image cropping to 1200x630 for social sharing
- Panel blueprints for page-level and site-level SEO fields
- Multi-language support (locale detection)
- Conditional rendering (empty fields produce no HTML output)

## Requirements

- PHP ^8.2
- Kirby ^4.0.1 or ^5.0

## Installation

```bash
composer require benjaminhaeberli/kirby-seo
```

## Usage

### 1. Add the site-level blueprint

In your `site.yml` blueprint, include the SEO fields for global settings (site title, OG image, Twitter handles):

```yaml
# site/blueprints/site.yml
tabs:
  seo:
    label: SEO
    fields:
      seo: fields/seo/site
```

### 2. Add the page-level blueprint

In any page blueprint, include the SEO fields (meta title, description, keywords, canonical URL):

```yaml
# site/blueprints/pages/default.yml
tabs:
  seo:
    label: SEO
    fields:
      seo: fields/seo/meta
```

### 3. Render the meta tags

In your `header.php` snippet (or equivalent), add the SEO snippet inside `<head>`:

```php
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php snippet('seo/meta') ?>
</head>
```

### Output example

The snippet generates the following HTML (tags with empty values are omitted):

```html
<base href="https://example.com">

<title>Page title</title>
<meta content="Page description." name="description">
<meta content="keyword1, keyword2" name="keywords">
<meta content="index, follow, noodp" name="robots">
<link href="https://example.com/canonical" rel="canonical">

<meta content="Page title" property="og:title">
<meta content="website" property="og:type">
<meta content="My Site" property="og:site_name">
<meta content="https://example.com/page" property="og:url">
<meta content="https://example.com/image.jpg" property="og:image">
<meta content="Page description." property="og:description">
<meta content="fr_FR" property="og:locale">

<meta content="Page title" name="twitter:title">
<meta content="summary_large_image" name="twitter:card">
<meta content="@site" name="twitter:site">
<meta content="@creator" name="twitter:creator">
<meta content="https://example.com/image.jpg" name="twitter:image">
<meta content="Page description." name="twitter:description">
```

## Panel fields

### Site-level (`fields/seo/site`)

| Field | Type | Description |
|-------|------|-------------|
| Site title | `text` | Used as `og:site_name` |
| Image | `files` | OG/Twitter image (cropped to 1200x630) |
| Twitter (Creator) | `text` | `@handle` of the content author |
| Twitter (Site) | `text` | `@handle` of the website |

### Page-level (`fields/seo/meta`)

| Field | Type | Description |
|-------|------|-------------|
| Meta title | `text` | `<title>` and `og:title` |
| Meta description | `textarea` | `<meta name="description">` and `og:description` |
| Keywords | `tags` | `<meta name="keywords">` |
| Canonical URL | `url` | `<link rel="canonical">` (defaults to site URL) |

## Panel translations

Blueprint labels and help texts are available in **English** and **French**. Contributions for additional languages are welcome via pull request -- simply add a new language key to the YAML files in `blueprints/fields/`.

## Development

```bash
composer install
composer test          # Run all checks (rector, pint, phpstan, pest)
composer test:unit     # Run Pest tests only
composer test:types    # Run PHPStan only
composer lint          # Run Pint code formatter
composer refacto       # Run Rector refactoring
```

## Inspiration

- [diesdasdigital/kirby-meta-knight](https://github.com/diesdasdigital/kirby-meta-knight)
- [fabianmichael/kirby-meta](https://github.com/fabianmichael/kirby-meta)

## License

[MIT](./LICENSE)
