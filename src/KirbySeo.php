<?php

declare(strict_types=1);

namespace BenjaminHaeberli\KirbySeo;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Toolkit\A;

final class KirbySeo implements KirbySeoInterface
{
    private string $metaTitle = '';

    private string $metaDescription = '';

    private string $metaKeywords = '';

    private string $metaRobots = '';

    private string $metaUrl = '';

    private string $metaImageUrl = '';

    private string $metaCanonicalUrl = '';

    private string $ogType = '';

    private string $ogSitename = '';

    private string $ogLocale = '';

    private string $twitterCard = '';

    private string $twitterSite = '';

    private string $twitterCreator = '';

    final public function __construct(App $kirby, Page $page)
    {
        // Site based meta
        if ($seoobject = $kirby->site()->kirbyseositeobject()->toObject()) {
            $this->metaImageUrl =  $seoobject->kirbyseoimage()->toFile()?->crop(1200, 630)->url() ?: '';
            $this->ogSitename = $seoobject->kirbyseositetitle()->value() ?: '';
            $this->twitterSite = $seoobject->kirbyseotwitterurl()->value() ?: '';
            $this->twitterCreator = $seoobject->kirbyseotwittercreator()->value() ?: '';
        }

        // Page based meta
        if ($seoobject = $page->kirbyseoobject()->toObject()) {
            $this->metaTitle = $seoobject->kirbyseometatitle()->value() ?: '';
            $this->metaDescription = $seoobject->kirbyseometadesc()->value() ?: '';
            $this->metaKeywords = $seoobject->kirbyseokeywords()->value() ?: '';
            $this->metaCanonicalUrl = $seoobject->kirbyseocanonicalurl()->toString() ?: site()->url();
        }

        // Static meta
        $this->metaRobots = 'index, follow, noodp';
        $this->metaUrl = $page->url();
        $this->ogType = 'website';
        $this->ogLocale = A::first(kirby()->language()->locale());
        $this->twitterCard = 'summary_large_image';
    }

    public function getMetaTitle(): string
    {
        return $this->metaTitle;
    }

    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    public function getMetaKeywords(): string
    {
        return $this->metaKeywords;
    }

    public function getMetaRobots(): string
    {
        return $this->metaRobots;
    }

    public function getMetaUrl(): string
    {
        return $this->metaUrl;
    }

    public function getMetaImageUrl(): string
    {
        return $this->metaImageUrl;
    }

    public function getMetaCanonicalUrl(): string
    {
        return $this->metaCanonicalUrl;
    }

    public function getOgType(): string
    {
        return $this->ogType;
    }

    public function getOgSitename(): string
    {
        return $this->ogSitename;
    }

    public function getOgLocale(): string
    {
        return $this->ogLocale;
    }

    public function getTwitterCard(): string
    {
        return $this->twitterCard;
    }

    public function getTwitterSite(): string
    {
        return $this->twitterSite;
    }

    public function getTwitterCreator(): string
    {
        return $this->twitterCreator;
    }
}
