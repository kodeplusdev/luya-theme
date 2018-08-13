<?php

/**
 * @var $this luya\web\View
 */

use trk\theme\Module;

use app\assets\ResourcesAsset;

use trk\theme\widgets\Navigation;
use trk\theme\widgets\Languages;

use luya\cms\tags\PageTag;

// Set website url
Module::setConfig('appUrl', $this->publicHtml ?: '/');
// Set current page
Module::setConfig('page', Yii::$app->menu->current);
// Set current language
Module::setConfig('language', Yii::$app->composition->language);
// Set website title
Module::setConfig('title', $this->title);
// Set website logo image
Module::setConfig('logo', 'image', Module::getConfig('appUrl') . 'images/logo/logo.png');
// Set website mobile-logo image
Module::setConfig('mobile', 'image', Module::getConfig('appUrl') . 'images/logo/logo-mobile.png');
// Set website favicon
Module::setConfig('icons', 'favicon', Module::getConfig('appUrl') . 'images/logo/favicon.png');
// Set website touch-icon
Module::setConfig('icons', 'touchicon', Module::getConfig('appUrl') . 'images/logo/touch-icon.png');

// Load parser
$parser = new PageTag();

// Header
$header = Yii::$app->menu->find()->where(['alias' => 'header'])->container('system')->with('hidden')->one();
Module::sidebar('header', $header ? $parser->parse($header->navId, 'content') : "");
// Content
Module::sidebar('content', $parser->parse(Yii::$app->menu->current->navId, 'content'));
// Footer
$footer = Yii::$app->menu->find()->where(['alias' => 'footer'])->container('system')->with('hidden')->one();
Module::sidebar('footer', $footer ? $parser->parse($footer->navId, 'content') : "");
// Social
$social = Yii::$app->menu->find()->where(['alias' => 'social'])->container('system')->with('hidden')->one();
Module::sidebar('social', $social ? $parser->parse($social->navId, 'content') : "");
// Set navigation data
$navigation = Navigation::toArray();
Module::sidebar('navbar', Module::render('templates/menu/menu', ['items' => array_merge($navigation, Languages::toArray()), 'position' => 'navbar']));
Module::sidebar('mobile', Module::render('templates/menu/menu', ['items' => $navigation, 'position' => 'offcanvas']));

ResourcesAsset::register($this);

Yii::$app->view->beginPage();

echo Module::render('header');

echo Module::sidebar('content');

echo Module::render('footer');

Yii::$app->view->endPage();