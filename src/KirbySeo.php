<?php

declare(strict_types=1);

namespace BenjaminHaeberli\KirbySeo;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Cms\Url;
use Kirby\Toolkit\A;

final class KirbySeo implements KirbySeoInterface
{
    private ?Field  $metaTitle = null;

    private ?Field  $metaDescription = null;

    private ?Field  $metaKeywords = null;

    private string $metaRobots = '';

    private string $metaUrl = '';

    private string $metaImageUrl = '';

    private string  $metaCanonicalUrl = '';

    private string $ogType = '';

    private ?Field $ogSitename = null;

    private string $ogLocale = '';

    private string $twitterCard = '';

    private string $twitterSite = '';

    private string $twitterCreator = '';

    final public function __construct(App $kirby, Page $page)
    {
        $site = $kirby->site();

        if ($seoobject = $page->kirbyseoobject()->toObject()) {
            $this->metaTitle = $seoobject->kirbyseometatitle();
            $this->metaDescription = $seoobject->kirbyseometadesc();
            $this->metaKeywords = $seoobject->kirbyseokeywords();
            $this->metaCanonicalUrl = $seoobject->kirbyseocanonicalurl()->isNotEmpty() ? $seoobject->kirbyseocanonicalurl()->toString() : site()->url();
        }

        $this->metaRobots = 'index, follow, noodp';
        $this->metaUrl = $page->url();
        /* $this->metaImageUrl        =   $page->shareimage()->toFile() ? $page->shareimage()->toFile()->crop(1280, 720)->url() : ''; */
        $this->metaImageUrl = Url::to('assets/og_image.jpg');

        // Facebook Meta
        $this->ogType = 'website';
        $this->ogSitename = $site->title();
        $this->ogLocale = A::first(kirby()->language()->locale());

        // Twitter  Meta
        $this->twitterCard = 'summary_large_image';
        $this->twitterSite = $site->socialtwitterurl()->isNotEmpty() ? $site->socialtwitterurl() : '';
        $this->twitterCreator = $site->twittercreator()->isNotEmpty() ? $site->twittercreator() : '';
    }

    public function getMetaTitle(): ?Field
    {
        return $this->metaTitle;
    }

    public function getMetaDescription(): ?Field
    {
        return $this->metaDescription;
    }

    public function getMetaKeywords(): ?Field
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

    public function getOgSitename(): ?Field
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
