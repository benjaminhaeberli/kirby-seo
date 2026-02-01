<?php

use Kirby\Cms\App;
use Kirby\Data\Yaml;

afterEach(function (): void {
    restore_error_handler();
    restore_exception_handler();
    App::destroy();
});

/**
 * @param  array<string, string>  $siteContent
 * @param  array<string, string>  $pageContent
 */
function renderMetaSnippet(array $siteContent = [], array $pageContent = []): string
{
    $app = new App([
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
    ]);

    $app->site()->visit('test');

    ob_start();
    include dirname(__DIR__) . '/snippets/meta.php';

    return ob_get_clean();
}

// --- Base tag ---

test('renders base tag with site URL', function (): void {
    $html = renderMetaSnippet();

    expect($html)->toContain('<base href=');
});

// --- Static meta tags ---

test('renders robots meta tag', function (): void {
    $html = renderMetaSnippet();

    expect($html)->toContain('<meta content="index, follow, noodp" name="robots">');
});

test('renders og:type meta tag', function (): void {
    $html = renderMetaSnippet();

    expect($html)->toContain('<meta content="website" property="og:type">');
});

test('renders twitter:card meta tag', function (): void {
    $html = renderMetaSnippet();

    expect($html)->toContain('<meta content="summary_large_image" name="twitter:card">');
});

// --- Page-level meta tags ---

test('renders title tag when meta title is set', function (): void {
    $html = renderMetaSnippet([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometatitle' => 'My Page Title',
        ]),
    ]);

    expect($html)->toContain('<title>My Page Title</title>');
});

test('renders meta description when set', function (): void {
    $html = renderMetaSnippet([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometadesc' => 'A test description.',
        ]),
    ]);

    expect($html)->toContain('<meta content="A test description." name="description">');
});

test('renders meta keywords when set', function (): void {
    $html = renderMetaSnippet([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseokeywords' => 'seo, kirby, test',
        ]),
    ]);

    expect($html)->toContain('<meta content="seo, kirby, test" name="keywords">');
});

// --- Open Graph tags ---

test('renders og:title when meta title is set', function (): void {
    $html = renderMetaSnippet([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometatitle' => 'OG Title Test',
        ]),
    ]);

    expect($html)->toContain('<meta content="OG Title Test" property="og:title">');
});

test('renders og:site_name when site title is set', function (): void {
    $html = renderMetaSnippet([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseositetitle' => 'My Site Name',
        ]),
    ]);

    expect($html)->toContain('<meta content="My Site Name" property="og:site_name">');
});

test('renders og:description when meta description is set', function (): void {
    $html = renderMetaSnippet([], [
        'kirbyseoobject' => Yaml::encode([
            'kirbyseometadesc' => 'OG description test.',
        ]),
    ]);

    expect($html)->toContain('<meta content="OG description test." property="og:description">');
});

// --- Twitter Card tags ---

test('renders twitter:site when set', function (): void {
    $html = renderMetaSnippet([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseotwitterurl' => '@mysite',
        ]),
    ]);

    expect($html)->toContain('<meta content="@mysite" name="twitter:site">');
});

test('renders twitter:creator when set', function (): void {
    $html = renderMetaSnippet([
        'kirbyseositeobject' => Yaml::encode([
            'kirbyseotwittercreator' => '@author',
        ]),
    ]);

    expect($html)->toContain('<meta content="@author" name="twitter:creator">');
});

// --- Conditional rendering ---

test('does not render title tag when meta title is empty', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('<title>');
});

test('does not render meta description when not set', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('name="description"');
});

test('does not render meta keywords when not set', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('name="keywords"');
});

test('does not render og:image when no image exists', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('property="og:image"');
});

test('does not render twitter:site when not set', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('name="twitter:site"');
});

test('does not render twitter:creator when not set', function (): void {
    $html = renderMetaSnippet();

    expect($html)->not->toContain('name="twitter:creator"');
});

// --- Full output ---

test('renders complete meta output with all data', function (): void {
    $html = renderMetaSnippet(
        [
            'kirbyseositeobject' => Yaml::encode([
                'kirbyseositetitle' => 'My Site',
                'kirbyseotwitterurl' => '@site',
                'kirbyseotwittercreator' => '@creator',
            ]),
        ],
        [
            'kirbyseoobject' => Yaml::encode([
                'kirbyseometatitle' => 'Page Title',
                'kirbyseometadesc' => 'Page description.',
                'kirbyseokeywords' => 'seo, test',
                'kirbyseocanonicalurl' => 'https://example.com/page',
            ]),
        ],
    );

    // Standard meta
    expect($html)->toContain('<title>Page Title</title>')
        ->and($html)->toContain('<meta content="Page description." name="description">')
        ->and($html)->toContain('<meta content="seo, test" name="keywords">')
        ->and($html)->toContain('<meta content="index, follow, noodp" name="robots">')
        ->and($html)->toContain('<link href="https://example.com/page" rel="canonical">');

    // Open Graph
    expect($html)->toContain('<meta content="Page Title" property="og:title">')
        ->and($html)->toContain('<meta content="website" property="og:type">')
        ->and($html)->toContain('<meta content="My Site" property="og:site_name">')
        ->and($html)->toContain('<meta content="Page description." property="og:description">');

    // Twitter Card
    expect($html)->toContain('<meta content="Page Title" name="twitter:title">')
        ->and($html)->toContain('<meta content="summary_large_image" name="twitter:card">')
        ->and($html)->toContain('<meta content="@site" name="twitter:site">')
        ->and($html)->toContain('<meta content="@creator" name="twitter:creator">')
        ->and($html)->toContain('<meta content="Page description." name="twitter:description">');
});
