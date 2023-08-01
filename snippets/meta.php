<?php

use BenjaminHaeberli\KirbySeo\KirbySeo;
use Kirby\Toolkit\Html;

$kirbyseo = new KirbySeo(kirby(), page());

// Meta
$metaCanonicalUrl = $kirbyseo->getMetaCanonicalUrl();
$metaDescription = $kirbyseo->getMetaDescription();
$metaImageUrl = $kirbyseo->getMetaImageUrl();
$metaKeywords = $kirbyseo->getMetaKeywords();
$metaRobots = $kirbyseo->getMetaRobots();
$metaTitle = $kirbyseo->getMetaTitle();
$metaUrl = $kirbyseo->getMetaUrl();

// Facebook Open Graph
$ogLocale = $kirbyseo->getOgLocale();
$ogSitename = $kirbyseo->getOgSitename();
$ogType = $kirbyseo->getOgType();

// Twitter Card
$twitterCard = $kirbyseo->getTwitterCard();
$twitterCreator = $kirbyseo->getTwitterCreator();
$twitterSite = $kirbyseo->getTwitterSite();
?>

<?php e(site()->url(), Html::tag('base', '', ['href' => site()->url()]) . PHP_EOL) ?>

<?php e($metaTitle, Html::tag('title', [$metaTitle]) . PHP_EOL)  ?>
<?php e($metaDescription, Html::tag('meta', '', ['name' => 'description', 'content' => $metaDescription]) . PHP_EOL) ?>
<?php e($metaKeywords, Html::tag('meta', '', ['name' => 'keywords', 'content' => $metaKeywords]) . PHP_EOL) ?>
<?php e($metaRobots, Html::tag('meta', '', ['name' => 'robots', 'content' => $metaRobots]) . PHP_EOL)  ?>
<?php e($metaCanonicalUrl, Html::tag('link', '', ['href' => $metaCanonicalUrl, 'rel' => 'canonical']) . PHP_EOL)  ?>

<?php e($metaTitle, Html::tag('meta', '', ['property' => 'og:title', 'content' => $metaTitle]) . PHP_EOL) ?>
<?php e($ogType, Html::tag('meta', '', ['property' => 'og:type', 'content' => $ogType]) . PHP_EOL)  ?>
<?php e($ogSitename, Html::tag('meta', '', ['property' => 'og:site_name', 'content' => $ogSitename]) . PHP_EOL)  ?>
<?php e($metaUrl, Html::tag('meta', '', ['property' => 'og:url', 'content' => $metaUrl]) . PHP_EOL)  ?>
<?php e($metaImageUrl, Html::tag('meta', '', ['property' => 'og:image', 'content' => $metaImageUrl]) . PHP_EOL)  ?>
<?php e($metaDescription, Html::tag('meta', '', ['property' => 'og:description', 'content' => $metaDescription]) . PHP_EOL)  ?>
<?php e($ogLocale, Html::tag('meta', '', ['property' => 'og:locale', 'content' => $ogLocale]) . PHP_EOL)  ?>

<?php e($metaTitle, Html::tag('meta', '', ['name' => 'twitter:title', 'content' => $metaTitle]) . PHP_EOL) ?>
<?php e($twitterCard, Html::tag('meta', '', ['name' => 'twitter:card', 'content' => $twitterCard]) . PHP_EOL)  ?>
<?php e($twitterSite, Html::tag('meta', '', ['name' => 'twitter:site', 'content' => $twitterSite]) . PHP_EOL)  ?>
<?php e($twitterCreator, Html::tag('meta', '', ['name' => 'twitter:creator', 'content' => $twitterCreator]) . PHP_EOL)  ?>
<?php e($metaImageUrl, Html::tag('meta', '', ['name' => 'twitter:image', 'content' => $metaImageUrl]) . PHP_EOL)  ?>
<?php e($metaDescription, Html::tag('meta', '', ['name' => 'twitter:description', 'content' => $metaDescription]) . PHP_EOL)  ?>
