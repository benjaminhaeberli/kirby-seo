<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby\Cms\App::plugin('benjaminhaeberli/kirby-seo', [
    'snippets' => [
        'seo/meta' => __DIR__ . '/snippets/meta.php',
    ],
    'blueprints' => [
        'fields/seo/meta' => __DIR__ . '/blueprints/fields/seo.yml'
    ]
]);
