<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/snippets',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    #  SetList::PRIVATIZATION
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
    ]);

    $rectorConfig->autoloadPaths([
        './src/bootstrap.php'
    ]);
};
