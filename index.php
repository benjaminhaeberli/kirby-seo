<?php

use Kirby\Cms\App;

@include_once __DIR__ . '/vendor/autoload.php';

App::plugin('benjaminhaeberli/kirby-seo', [
    'snippets' => [
        'seo/meta' => __DIR__ . '/snippets/meta.php',
    ],
    'blueprints' => [
        'fields/seo/meta' => __DIR__ . '/blueprints/fields/seo.yml',
        'fields/seo/site' => __DIR__ . '/blueprints/fields/site.yml',
    ],
    'translations' => [
        'en' => require __DIR__ . '/translations/en.php',
        'fr' => require __DIR__ . '/translations/fr.php',
    ],
]);
