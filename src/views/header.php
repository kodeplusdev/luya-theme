<?php

use trk\theme\Theme;

$site = Theme::get('site');
$header = Theme::get('header');
$mobile = Theme::get('mobile');

// Page
$attrs_page = [];
$attrs_page_container = [];

$attrs_page['class'][] = 'avb-page';

if ($site['layout'] == 'boxed') {

    $attrs_page['class'][] = $site['boxed_alignment'] ? 'uk-margin-auto' : '';

    $attrs_page_container['class'][] = 'avb-page-container';
    $attrs_page_container['class'][] = $site['boxed_padding'] ? 'avb-page-container-padding' : '';
    $attrs_page_container['style'][] = $site['boxed_media'] ? "background-image: url('" . Theme::get('appUrl') . $site['boxed_media'] . "');" : '';

}
?>
<!DOCTYPE html>
<html lang="<?= Theme::get('language') ?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if(Theme::get('icons', 'favicon')): ?>
            <link rel="shortcut icon" href="<?= Theme::get('icons', 'favicon') ?>">
        <?php endif; ?>
        <?php if(Theme::get('icons', 'touchicon')): ?>
            <link rel="apple-touch-icon-precomposed" href="<?= Theme::get('icons', 'touchicon') ?>">
        <?php endif; ?>
        <title><?= Theme::get('title') ?></title>
        <?php Yii::$app->view->head(); ?>
    </head>
    <body>
    <?php Yii::$app->view->beginBody(); ?>
        <?php if (strpos($header['layout'], 'offcanvas') === 0 || $mobile['animation'] == 'offcanvas') : ?>
        <div class="uk-offcanvas-content">
        <?php endif ?>

        <?php if ($site['layout'] == 'boxed') : ?>
        <div<?= Theme::attrs($attrs_page_container) ?>>
        <?php endif ?>

        <div<?= Theme::attrs($attrs_page) ?>>

            <div class="avb-header-mobile uk-hidden@<?= $mobile['breakpoint'] ?>">
            <?= Theme::view('templates/header-mobile') ?>
            </div>

            <?php if (Theme::sidebar('toolbar-left') || Theme::sidebar('toolbar-right')) : ?>
            <div class="avb-toolbar uk-visible@<?= $mobile['breakpoint'] ?>">
                <div class="uk-container uk-flex uk-flex-middle <?= $site['toolbar_fullwidth'] ? 'uk-container-expand' : '' ?> <?= $site['toolbar_center'] ? 'uk-flex-center' : '' ?>">

                    <?php if (Theme::sidebar('toolbar-left') || ($site['toolbar_center'] && Theme::sidebar('toolbar-right'))) : ?>
                    <div>
                        <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">
                            <?php if (Theme::sidebar('toolbar-left')) : ?>
                                <?php echo Theme::sidebar("toolbar-left:cell") ?>
                            <?php endif ?>
                            <?php if ($site['toolbar_center'] && Theme::sidebar('toolbar-right')) : ?>
                                <?php echo Theme::sidebar("toolbar-right:cell") ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endif ?>

                    <?php if (!$site['toolbar_center'] && Theme::sidebar('toolbar-right')) : ?>
                    <div class="uk-margin-auto-left">
                        <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">
                            <?php echo Theme::sidebar("toolbar-right:cell") ?>
                        </div>
                    </div>
                    <?php endif ?>

                </div>
            </div>
            <?php endif ?>

            <?= Theme::view('templates/header') ?>

            <?php echo Theme::sidebar("top:section") ?>

            <?php if (!Theme::sidebar('content')) : ?>

            <div id="avb-main" class="avb-main uk-section uk-section-default" uk-height-viewport="expand: true">
                <div class="uk-container">

                    <?php
                        $grid = ['uk-grid'];
                        $sidebar = Theme::get('sidebar');
                        $grid[] = $sidebar['gutter'] ? "uk-grid-{$sidebar['gutter']}" : '';
                        $grid[] = $sidebar['divider'] ? "uk-grid-divider" : '';
                    ?>

                    <div<?= Theme::attrs(['class' => $grid, 'uk-grid' => true]) ?>>
                        <div class="uk-width-expand@<?= $sidebar['breakpoint'] ?>">

                            <?php if ($site['breadcrumbs']) : ?>
                            <div class="uk-margin-medium-bottom">
                                <?= Theme::view('breadcrumbs') ?>
                            </div>
                            <?php endif ?>

            <?php endif ?>
