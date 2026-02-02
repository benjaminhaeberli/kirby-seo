<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/snippets',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withAutoloadPaths([
        './src/bootstrap.php',
    ])
    ->withPhpSets(php82: true)
    ->withPreparedSets(
        codeQuality: true,
        deadCode: true,
        privatization: true,
        typeDeclarations: true,
    );
