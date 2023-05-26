<?php

declare(strict_types=1);

namespace KirbySeo;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Cms\Site;

interface KirbySeoInterface
{
    public function __construct(Page $page, App $kirby, Site $site);

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
