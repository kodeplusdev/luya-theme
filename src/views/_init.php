<?php

/**
 * @var $this luya\web\View
 */

use trk\theme\Theme;
use trk\theme\widgets\Navigation;
use trk\theme\widgets\Languages;

use luya\cms\tags\PageTag;

// Set website title
Theme::set('title', $this->title);
// Set website logo image
Theme::set('logo', 'image', Theme::get('appUrl') . '/images/logo/logo.png');

// Load parser
$parser = new PageTag();

// Header
$header = Yii::$app->menu->find()->where(['alias' => 'header'])->container('system')->with('hidden')->one();
Theme::sidebar('header', $header ? $parser->parse($header->navId, 'content') : "");
// Content
Theme::sidebar('content', $parser->parse(Yii::$app->menu->current->navId, 'content'));
// Footer
$footer = Yii::$app->menu->find()->where(['alias' => 'footer'])->container('system')->with('hidden')->one();
Theme::sidebar('footer', $footer ? $parser->parse($footer->navId, 'content') : "");
// Social
$social = Yii::$app->menu->find()->where(['alias' => 'social'])->container('system')->with('hidden')->one();
Theme::sidebar('social', $social ? $parser->parse($social->navId, 'content') : "");
// Set navigation data
$navigation = Navigation::toArray();
Theme::sidebar('navbar', Theme::view('templates/menu/menu', ['items' => array_merge($navigation, Languages::toArray()), 'position' => 'navbar']));
Theme::sidebar('mobile', Theme::view('templates/menu/menu', ['items' => $navigation, 'position' => 'offcanvas']));