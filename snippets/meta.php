<?php

use KirbySeo\KirbySeo;
use Kirby\Toolkit\Html;

$kirbyseo = new KirbySeo(page(), kirby(), site());
?>

<?= Html::tag('base', null, ['href' => site()->url()]) . PHP_EOL ?>

<?= Html::tag('title', [$kirbyseo->getMetaTitle()]) . PHP_EOL ?>

<?= Html::tag('meta', null, ['name' => 'description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'keywords', 'content' => $kirbyseo->getMetaKeywords()]) . PHP_EOL ?>

<?= Html::tag('meta', null, ['property' => 'og:title', 'content' => $kirbyseo->getMetaTitle()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:type', 'content' => $kirbyseo->getOgType()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:site_name', 'content' => $kirbyseo->getOgSitename()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:url', 'content' => $kirbyseo->getMetaUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:image', 'content' => $kirbyseo->getMetaImageUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['property' => 'og:locale', 'content' => $kirbyseo->getOgLocale()]) . PHP_EOL ?>

<?= Html::tag('meta', null, ['name' => 'twitter:title', 'content' => $kirbyseo->getMetaTitle()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'twitter:card', 'content' => $kirbyseo->getTwitterCard()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'twitter:site', 'content' => $kirbyseo->getTwitterSite()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'twitter:creator', 'content' => $kirbyseo->getTwitterCreator()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'twitter:image', 'content' => $kirbyseo->getMetaImageUrl()]) . PHP_EOL ?>
<?= Html::tag('meta', null, ['name' => 'twitter:description', 'content' => $kirbyseo->getMetaDescription()]) . PHP_EOL ?>

<?= Html::tag('meta', null, ['name' => 'robots', 'content' => $kirbyseo->getMetaRobots()]) . PHP_EOL ?>

<?= Html::tag('link', null, ['href' => $kirbyseo->getMetaCanonicalUrl(), 'rel' => 'canonical']) . PHP_EOL ?>

