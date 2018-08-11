<?php

/**
 * @var $this luya\web\View
 */

use trk\theme\Theme;

use app\assets\ResourcesAsset;

Theme::view('_init');

ResourcesAsset::register($this);

Yii::$app->view->beginPage();

echo Theme::view('header');

echo Theme::sidebar('content');

echo Theme::view('footer');

Yii::$app->view->endPage();