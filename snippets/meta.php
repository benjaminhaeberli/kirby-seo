<?php

use BenjaminHaeberli\KirbySeo\KirbySeo;
use Kirby\Toolkit\Html;

$kirbyseo = new KirbySeo(kirby(), page());
?>

<?= Html::tag('base', '', ['href' => site()->url()]) . PHP_EOL ?>

<?= Html::tag('title', [$kirbyseo->getMetaTitle()]) . PHP_EOL ?>

<?= Html::tag('meta', '', ['name' => 'description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'keywords', 'content' => $kirbyseo->getMetaKeywords()]) . PHP_EOL ?>

<?= Html::tag('meta', '', ['property' => 'og:title', 'content' => $kirbyseo->getMetaTitle()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:type', 'content' => $kirbyseo->getOgType()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:site_name', 'content' => $kirbyseo->getOgSitename()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:url', 'content' => $kirbyseo->getMetaUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:image', 'content' => $kirbyseo->getMetaImageUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['property' => 'og:locale', 'content' => $kirbyseo->getOgLocale()]) . PHP_EOL ?>

<?= Html::tag('meta', '', ['name' => 'twitter:title', 'content' => $kirbyseo->getMetaTitle()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'twitter:card', 'content' => $kirbyseo->getTwitterCard()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'twitter:site', 'content' => $kirbyseo->getTwitterSite()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'twitter:creator', 'content' => $kirbyseo->getTwitterCreator()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'twitter:image', 'content' => $kirbyseo->getMetaImageUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', '', ['name' => 'twitter:description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>

<?= Html::tag('meta', '', ['name' => 'robots', 'content' => $kirbyseo->getMetaRobots()]) . PHP_EOL ?>

<?= Html::tag('link', '', ['href' => $kirbyseo->getMetaCanonicalUrl(), 'rel' => 'canonical']) . PHP_EOL ?>
