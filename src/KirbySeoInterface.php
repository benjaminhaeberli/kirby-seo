<?php

declare(strict_types=1);

namespace BenjaminHaeberli\KirbySeo;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Page;

interface KirbySeoInterface
{
    public function __construct(App $kirby, Page $page);

    public function getMetaTitle(): ?Field;

    public function getMetaDescription(): ?Field;

    public function getMetaKeywords(): ?Field;

    public function getMetaRobots(): string;

    public function getMetaUrl(): string;

    public function getMetaImageUrl(): string;

    public function getMetaCanonicalUrl(): string;

    public function getOgType(): string;

    public function getOgSitename(): ?Field;

    public function getOgLocale(): string;

    public function getTwitterCard(): string;

    public function getTwitterSite(): string;

    public function getTwitterCreator(): string;
}
