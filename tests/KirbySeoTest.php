<?php

use BenjaminHaeberli\KirbySeo\KirbySeo;
use BenjaminHaeberli\KirbySeo\KirbySeoInterface;
use Kirby\Cms\App;
use Kirby\Data\Yaml;

/**
 * @param  array<string, string>        $siteContent
 * @param  array<string, string>        $pageContent
 * @param  list<array<string, mixed>>   $languages
 */
function createTestApp(array $siteContent = [], array $pageContent = [], array $languages = []): App
{
    $config = [
        'roots' => [
            'index' => '/dev/null',
        ],
        'site' => [
            'content' => $siteContent,
            'children' => [
                [
                    'slug' => 'test',
                    'content' => array_merge(['title' => 'Test Page'], $pageContent),
                ],
            ],
        ],
    ];

    if ($languages !== []) {
        $config['languages'] = $languages;
    }

    return new App($config);
}

/**
 * @param  array<string, string>  $siteContent
 * @param  array<string, string>  $pageContent
 */
function createSeoInstance(array $siteContent = [], array $pageContent = []): KirbySeo
{
    $app = createTestApp($siteContent, $pageContent);
    $page = $app->site()->children()->first();

    return new KirbySeo($app, $page);
}

afterEach(function (): void {
    // Kirby registers Whoops error/exception handlers in App constructor.
    // Restore the previous handlers to avoid PHPUnit risky test warnings.
    restore_error_handler();
    restore_exception_handler();
    App::destroy();
});

// --- Interface ---

test('implements KirbySeoInterface', function (): void {
    $seo = createSeoInstance();

    expect($seo)->toBeInstanceOf(KirbySeoInterface::class);
});

// --- Return types ---

test('all getters return strings', function (): void {
    $seo = createSeoInstance();

    expect($seo->getMetaTitle())->toBeString()
        ->and($seo->getMetaDescription())->toBeString()
        ->and($seo->getMetaKeywords())->toBeString()
        ->and($seo->getMetaRobots())->toBeString()
        ->and($seo->getMetaUrl())->toBeString()
        ->and($seo->getMetaImageUrl())->toBeString()
        ->and($seo->getMetaCanonicalUrl())->toBeString()
        ->and($seo->getOgType())->toBeString()
        ->and($seo->getOgSitename())->toBeString()
        ->and($seo->getOgLocale())->toBeString()
        ->and($seo->getTwitterCard())->toBeString()
        ->and($seo->getTwitterSite())->toBeString()
        ->and($seo->getTwitterCreator())->toBeString();
});

// --- Static defaults ---

test('static defaults are always set', function (): void {
    $seo = createSeoInstance();

    expect($seo->getMetaRobots())->toBe('index, follow, noodp')
        ->and($seo->getOgType())->toBe('website')
        ->and($seo->getTwitterCard())->toBe('summary_large_image');
});

test('meta URL matches page URL', function (): void {
    $app = createTestApp();
    $page = $app->site()->children()->first();
    $seo = new KirbySeo($app, $page);

    expect($seo->getMetaUrl())->toBe($page->url());
});

// --- Empty data ---

test('returns empty strings when no SEO data is configured', function (): void {
    $seo = createSeoInstance();

    expect($seo->getMetaTitle())->toBe('')
        ->and($seo->getMetaDescription())->toBe('')
        ->and($seo->getMetaKeywords())->toBe('')
        ->and($seo->getMetaImageUrl())->toBe('')
        ->and($seo->getOgSitename())->toBe('')
        ->and($seo->getTwitterSite())->toBe('')
        ->and($seo->getTwitterCreator())->toBe('');
});

test('canonical URL always falls back to site URL when not explicitly set', function (): void {
    $app = createTestApp();
    $page = $app->site()->children()->first();
    $seo = new KirbySeo($app, $page);

    expect($seo->getMetaCanonicalUrl())->toBe($app->site()->url());
});

// --- Site-level SEO ---

test('reads site title from site SEO object', function (): void {
    $seo = createSeoInstance([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseositetitle' => 'My Awesome Site',
        ]),
    ]);

    expect($seo->getOgSitename())->toBe('My Awesome Site');
});

test('reads Twitter handles from site SEO object', function (): void {
    $seo = createSeoInstance([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseotwitterurl' => '@mysite',
            'kirbyseotwittercreator' => '@creator',
        ]),
    ]);

    expect($seo->getTwitterSite())->toBe('@mysite')
        ->and($seo->getTwitterCreator())->toBe('@creator');
});

test('image URL is empty when no image file exists', function (): void {
    $seo = createSeoInstance([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseositetitle' => 'My Site',
        ]),
    ]);

    expect($seo->getMetaImageUrl())->toBe('');
});

// --- Page-level SEO ---

test('reads meta title from page SEO object', function (): void {
    $seo = createSeoInstance([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometatitle' => 'My Page Title',
        ]),
    ]);

    expect($seo->getMetaTitle())->toBe('My Page Title');
});

test('reads meta description from page SEO object', function (): void {
    $seo = createSeoInstance([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometadesc' => 'A description for the test page.',
        ]),
    ]);

    expect($seo->getMetaDescription())->toBe('A description for the test page.');
});

test('reads keywords from page SEO object', function (): void {
    $seo = createSeoInstance([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseokeywords' => 'test, seo, kirby',
        ]),
    ]);

    expect($seo->getMetaKeywords())->toBe('test, seo, kirby');
});

// --- Canonical URL ---

test('canonical URL falls back to site URL when page has SEO data but no canonical', function (): void {
    $app = createTestApp([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometatitle' => 'Test',
        ]),
    ]);
    $page = $app->site()->children()->first();
    $seo = new KirbySeo($app, $page);

    expect($seo->getMetaCanonicalUrl())->toBe($app->site()->url());
});

test('uses custom canonical URL when provided', function (): void {
    $seo = createSeoInstance([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseocanonicalurl' => 'https://example.com/canonical',
        ]),
    ]);

    expect($seo->getMetaCanonicalUrl())->toBe('https://example.com/canonical');
});

// --- Language / Locale ---

test('ogLocale is empty in single-language mode', function (): void {
    $seo = createSeoInstance();

    expect($seo->getOgLocale())->toBe('');
});

test('ogLocale is set in multi-language mode', function (): void {
    $app = createTestApp([], [], [
        [
            'code' => 'fr',
            'name' => 'French',
            'default' => true,
            'locale' => 'fr_FR',
        ],
    ]);
    $page = $app->site()->children()->first();
    $seo = new KirbySeo($app, $page);

    expect($seo->getOgLocale())->toBe('fr_FR');
});

// --- Combined data ---

test('combines site and page SEO data correctly', function (): void {
    $seo = createSeoInstance(
        [
            'kirbyseositeobject' => Yaml::encode([
                'kirbyseositetitle' => 'My Site',
                'kirbyseotwitterurl' => '@site',
                'kirbyseotwittercreator' => '@author',
            ]),
        ],
        [
            'kirbyseoobject' => Yaml::encode([
                'kirbyseometatitle' => 'Page Title',
                'kirbyseometadesc' => 'Page description.',
                'kirbyseokeywords' => 'seo, kirby',
            ]),
        ],
    );

    // Site-level
    expect($seo->getOgSitename())->toBe('My Site')
        ->and($seo->getTwitterSite())->toBe('@site')
        ->and($seo->getTwitterCreator())->toBe('@author');

    // Page-level
    expect($seo->getMetaTitle())->toBe('Page Title')
        ->and($seo->getMetaDescription())->toBe('Page description.')
        ->and($seo->getMetaKeywords())->toBe('seo, kirby');

    // Static defaults still present
    expect($seo->getMetaRobots())->toBe('index, follow, noodp')
        ->and($seo->getOgType())->toBe('website')
        ->and($seo->getTwitterCard())->toBe('summary_large_image');
});
