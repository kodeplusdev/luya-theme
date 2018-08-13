<?php

use trk\theme\Module;
use trk\uikit\helpers\ArrayHelper;

$site = Module::getConfig('site');
$header = Module::getConfig('header');
$mobile = Module::getConfig('mobile');

// Page
$attrs_page = [];
$attrs_page_container = [];

$attrs_page['class'][] = 'avb-page';

if ($site['layout'] == 'boxed') {

    $attrs_page['class'][] = $site['boxed_alignment'] ? 'uk-margin-auto' : '';

    $attrs_page_container['class'][] = 'avb-page-container';
    $attrs_page_container['class'][] = $site['boxed_padding'] ? 'avb-page-container-padding' : '';
    $attrs_page_container['style'][] = $site['boxed_media'] ? "background-image: url('" . Module::getConfig('appUrl') . $site['boxed_media'] . "');" : '';

}
?>
<!DOCTYPE html>
<html lang="<?= Module::getConfig('language') ?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if($favicon = Module::getConfig('icons', 'favicon')): ?>
            <link rel="shortcut icon" href="<?= $favicon ?>">
        <?php endif; ?>
        <?php if($touch_icon = Module::getConfig('icons', 'touch_icon')): ?>
            <link rel="apple-touch-icon-precomposed" href="<?= $touch_icon ?>">
        <?php endif; ?>
        <title><?= Module::getConfig('title') ?></title>
        <?php Yii::$app->view->head(); ?>
    </head>
    <body>
    <?php Yii::$app->view->beginBody(); ?>
        <?php if (strpos($header['layout'], 'offcanvas') === 0 || $mobile['animation'] == 'offcanvas') : ?>
        <div class="uk-offcanvas-content">
        <?php endif ?>

        <?php if ($site['layout'] == 'boxed') : ?>
        <div<?= ArrayHelper::attrs($attrs_page_container) ?>>
        <?php endif ?>

        <div<?= ArrayHelper::attrs($attrs_page) ?>>

            <div class="avb-header-mobile uk-hidden@<?= $mobile['breakpoint'] ?>">
            <?= Module::render('templates/header-mobile') ?>
            </div>

            <?php if (Module::sidebar('toolbar-left') || Module::sidebar('toolbar-right')) : ?>
            <div class="avb-toolbar uk-visible@<?= $mobile['breakpoint'] ?>">
                <div class="uk-container uk-flex uk-flex-middle <?= $site['toolbar_full_width'] ? 'uk-container-expand' : '' ?> <?= $site['toolbar_center'] ? 'uk-flex-center' : '' ?>">

                    <?php if (Module::sidebar('toolbar-left') || ($site['toolbar_center'] && Module::sidebar('toolbar-right'))) : ?>
                    <div>
                        <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" data-uk-grid="margin: uk-margin-small-top">
                            <?php if (Module::sidebar('toolbar-left')) : ?>
                                <?php echo Module::sidebar("toolbar-left:cell") ?>
                            <?php endif ?>
                            <?php if ($site['toolbar_center'] && Module::sidebar('toolbar-right')) : ?>
                                <?php echo Module::sidebar("toolbar-right:cell") ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endif ?>

                    <?php if (!$site['toolbar_center'] && Module::sidebar('toolbar-right')) : ?>
                    <div class="uk-margin-auto-left">
                        <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" data-uk-grid="margin: uk-margin-small-top">
                            <?php echo Module::sidebar("toolbar-right:cell") ?>
                        </div>
                    </div>
                    <?php endif ?>

                </div>
            </div>
            <?php endif ?>

            <?= Module::render('templates/header') ?>

            <?php echo Module::sidebar("top:section") ?>

            <?php if (!Module::sidebar('content')) : ?>

            <div id="avb-main" class="avb-main uk-section uk-section-default" data-uk-height-viewport="expand: true">
                <div class="uk-container">

                    <?php
                        $grid = ['uk-grid'];
                        $sidebar = Module::getConfig('sidebar');
                        $grid[] = $sidebar['gutter'] ? "uk-grid-{$sidebar['gutter']}" : '';
                        $grid[] = $sidebar['divider'] ? "uk-grid-divider" : '';
                    ?>

                    <div<?= ArrayHelper::attrs(['class' => $grid, 'uk-grid' => true]) ?>>
                        <div class="uk-width-expand@<?= $sidebar['breakpoint'] ?>">

                            <?php if ($site['breadcrumbs']) : ?>
                            <div class="uk-margin-medium-bottom">
                                <?= Module::render('breadcrumbs') ?>
                            </div>
                            <?php endif ?>

            <?php endif ?>
