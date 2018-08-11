<?php

use trk\theme\Theme;

$header = Theme::get('header');
$logo = Theme::get('logo');
$mobile = Theme::get('mobile');
$navbar = Theme::get('navbar');

// Options
$layout = $header['layout'];
$fullwidth = $header['fullwidth'];
$logo_padding_remove = $fullwidth ? $header['logo_padding_remove'] : false;
$logo_center = $header['logo_center'];
$logo = $logo['image'] || $logo['text'];
$class = array_merge(['avb-header', 'uk-visible@' . $mobile['breakpoint']], isset($class) ? (array) $class : []);
$attrs = array_merge(['uk-header' => true], isset($attrs) ? (array) $attrs : []);
$attrs_sticky = [];

// Container
$container = ['class' => ['uk-navbar-container']];

// Navbar

// Dropdown options
if (!preg_match('/^(offcanvas|modal)/', $layout)) {

    $attrs_navbar = [
        'class' => 'uk-navbar',
        'uk-navbar' => json_encode(array_filter([
            'align' => $navbar['dropdown_align'],
            'boundary' => '!.uk-navbar-container',
            'boundary-align' => $navbar['dropdown_boundary'],
            'dropbar' => $navbar['dropbar'] ? true : null,
            'dropbar-anchor' => $navbar['dropbar'] ? '!.uk-navbar-container' : null,
            'dropbar-mode' => $navbar['dropbar']
        ]))
    ];

} else {

    $attrs_navbar = [
        'class' => 'uk-navbar',
        'uk-navbar' => true
    ];

}

// Sticky
if ($sticky = $navbar['sticky']) {
    $attrs_sticky = array_filter([
        'uk-sticky' => true,
        'media' => 768,
        'show-on-up' => $sticky == 2,
        'animation' => $sticky == 2 ? 'uk-animation-slide-top' : '',
        'cls-active' => 'uk-navbar-sticky',
        'sel-target' => '.uk-navbar-container',
    ]);
}

?>

<div<?= Theme::attrs(['class' => $class], $attrs) ?>>

<?php

/*
 * Horizontal layouts
 */

if (in_array($layout, ['horizontal-left', 'horizontal-center', 'horizontal-right'])) : ?>

    <?php if ($sticky) : ?>
    <div<?= Theme::attrs($attrs_sticky) ?>>
    <?php endif ?>

        <div<?= Theme::attrs($container) ?>>

            <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?><?= $logo && $logo_padding_remove ? ' uk-padding-remove-left' : '' ?>">
                <nav<?= Theme::attrs($attrs_navbar) ?>>

                    <?php if ($logo || $layout == 'horizontal-left' && Theme::sidebar('navbar')) : ?>
                    <div class="uk-navbar-left">

                        <?= $logo ? $this->render('header-logo', ['class' => 'uk-navbar-item', 'img' => 'uk-responsive-height']) : '' ?>

                        <?php if ($layout == 'horizontal-left') : ?>
                            <?php echo Theme::sidebar("navbar") ?>
                        <?php endif ?>

                    </div>
                    <?php endif ?>

                    <?php if ($layout == 'horizontal-center' && Theme::sidebar('navbar')) : ?>
                    <div class="uk-navbar-center">
                        <?php echo Theme::sidebar("navbar") ?>
                    </div>
                    <?php endif ?>

                    <?php if (Theme::sidebar('header') || $layout == 'horizontal-right' && Theme::sidebar('navbar')) : ?>
                    <div class="uk-navbar-right">

                        <?php if ($layout == 'horizontal-right' && Theme::sidebar('navbar')) : ?>
                            <?php echo Theme::sidebar("navbar") ?>
                        <?php endif ?>

                        <?php echo Theme::sidebar("header") ?>

                    </div>
                    <?php endif ?>

                </nav>
            </div>

        </div>

    <?php if ($sticky) : ?>
    </div>
    <?php endif ?>

<?php endif ?>

<?php

/*
 * Stacked Center layouts
 */

if (in_array($layout, ['stacked-center-a', 'stacked-center-b', 'stacked-center-split'])) : ?>

    <?php if ($logo && $layout != 'stacked-center-split' || $layout == 'stacked-center-a' && Theme::sidebar('header')) : ?>
    <div class="avb-headerbar-top">
        <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?>">

            <?php if ($logo) : ?>
            <div class="uk-text-center">
                <?= $this->render('header-logo') ?>
            </div>
            <?php endif ?>

            <?php if ($layout == 'stacked-center-a' && Theme::sidebar('header')) : ?>
            <div class="avb-headerbar-stacked uk-grid-medium uk-child-width-auto uk-flex-center uk-flex-middle" uk-grid>
                <?php echo Theme::sidebar("header:cell") ?>
            </div>
            <?php endif ?>

        </div>
    </div>
    <?php endif ?>

    <?php if (Theme::sidebar('navbar')) : ?>

        <?php if ($sticky) : ?>
        <div<?= Theme::attrs($attrs_sticky) ?>>
        <?php endif ?>

            <div<?= Theme::attrs($container) ?>>

                <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?>">
                    <nav<?= Theme::attrs($attrs_navbar) ?>>

                        <div class="uk-navbar-center">

                            <?php if ($layout == 'stacked-center-split') : ?>

                                <div class="uk-navbar-center-left"><div>
                                    <?php echo Theme::sidebar("navbar-split") ?>
                                </div></div>

                                <?= $this->render('header-logo', ['class' => 'uk-navbar-item', 'img' => 'uk-responsive-height']); ?>

                                <div class="uk-navbar-center-right"><div>
                                    <?php echo Theme::sidebar("navbar") ?>
                                </div></div>

                            <?php else: ?>
                                <?php echo Theme::sidebar("navbar") ?>
                            <?php endif ?>

                        </div>

                    </nav>
                </div>

            </div>

        <?php if ($sticky) : ?>
        </div>
        <?php endif ?>

    <?php endif ?>

    <?php if (in_array($layout, ['stacked-center-b', 'stacked-center-split']) && Theme::sidebar('header')) : ?>
    <div class="avb-headerbar-bottom">
        <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?>">
            <div class="uk-grid-medium uk-child-width-auto uk-flex-center uk-flex-middle" uk-grid>
                <?php echo Theme::sidebar("header:cell") ?>
            </div>
        </div>
    </div>
    <?php endif ?>

<?php endif ?>

<?php

/*
 * Stacked Left layouts
 */

if ($layout == 'stacked-left-a' || $layout == 'stacked-left-b') : ?>

    <?php if ($logo || Theme::sidebar('header')) : ?>
    <div class="avb-headerbar-top">
        <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?> uk-flex uk-flex-middle">

            <?= $logo ? $this->render('header-logo') : '' ?>

            <?php if (Theme::sidebar('header')) : ?>
            <div class="uk-margin-auto-left">
                <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid>
                    <?php echo Theme::sidebar("header:cell") ?>
                </div>
            </div>
            <?php endif ?>

        </div>
    </div>
    <?php endif ?>

    <?php if (Theme::sidebar('navbar')) : ?>

        <?php if ($sticky) : ?>
        <div<?= Theme::attrs($attrs_sticky) ?>>
        <?php endif ?>

            <div<?= Theme::attrs($container) ?>>

                <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?>">
                    <nav<?= Theme::attrs($attrs_navbar) ?>>

                        <?php if ($layout == 'stacked-left-a') : ?>
                        <div class="uk-navbar-left">
                            <?php echo Theme::sidebar("navbar") ?>
                        </div>
                        <?php endif ?>

                        <?php if ($layout == 'stacked-left-b') : ?>
                        <div class="uk-navbar-left uk-flex-auto">
                            <?php echo Theme::sidebar("navbar") ?>
                        </div>
                        <?php endif ?>

                    </nav>
                </div>

            </div>

        <?php if ($sticky) : ?>
        </div>
        <?php endif ?>

    <?php endif ?>

<?php endif ?>

<?php

/*
 * Toggle layouts
 */

if (preg_match('/^(offcanvas|modal)/', $layout)) :

    $attrs_toggle = [];

    $attrs_toggle['class'][] = strpos($layout, 'modal') === 0 ? 'uk-modal-body uk-padding-large uk-margin-auto' : 'uk-offcanvas-bar';
    $attrs_toggle['class'][] = $navbar['toggle_menu_center'] ? 'uk-text-center' : '';
    $attrs_toggle['class'][] = 'uk-flex uk-flex-column';

    if ($logo_center) {
        $logo_padding_remove = false;
    }

    ?>

    <?php if ($sticky) : ?>
    <div<?= Theme::attrs($attrs_sticky) ?>>
    <?php endif ?>

        <div<?= Theme::attrs($container) ?>>
            <div class="uk-container<?= $fullwidth ? ' uk-container-expand' : '' ?><?= $logo && $logo_padding_remove ? ' uk-padding-remove-left' : '' ?>">
                <nav<?= Theme::attrs($attrs_navbar) ?>>

                    <?php if ($logo) : ?>
                    <div class="<?= $logo_center ? 'uk-navbar-center' : 'uk-navbar-left' ?>">
                        <?= $this->render('header-logo', ['class' => 'uk-navbar-item', 'img' => 'uk-responsive-height']) ?>
                    </div>
                    <?php endif ?>

                    <?php if (Theme::sidebar('header') || Theme::sidebar('navbar')) : ?>
                    <div class="uk-navbar-right">

                        <?php echo Theme::sidebar("header") ?>

                        <?php if (Theme::sidebar('navbar')) : ?>

                            <a class="uk-navbar-toggle" href="#avb-navbar" uk-toggle>
                                <?php if ($navbar['toggle_text']) : ?>
                                <span class="uk-margin-small-right"><?= Yii::t('theme', 'Menu') ?></span>
                                <?php endif ?>
                                <div uk-navbar-toggle-icon></div>
                            </a>

                            <?php if (strpos($layout, 'offcanvas') === 0) : ?>
                            <div id="avb-navbar" uk-offcanvas="flip: true"<?= Theme::attrs($navbar['offcanvas'] ?: []) ?>>
                                <div<?= Theme::attrs($attrs_toggle) ?>>

                                    <button class="uk-offcanvas-close uk-close-large uk-margin-remove-adjacent" type="button" uk-close></button>

                                    <?php echo Theme::sidebar("navbar") ?>

                                </div>
                            </div>
                            <?php endif ?>

                            <?php if (strpos($layout, 'modal') === 0) : ?>
                            <div id="avb-navbar" class="uk-modal-full" uk-modal>
                                <div class="uk-modal-dialog uk-flex">

                                    <button class="uk-modal-close-full uk-close-large uk-margin-remove-adjacent" type="button" uk-close></button>

                                    <div <?= Theme::attrs($attrs_toggle) ?> uk-height-viewport>
                                        <?php echo Theme::sidebar("navbar") ?>
                                    </div>

                                </div>
                            </div>
                            <?php endif ?>

                        <?php endif ?>

                    </div>
                    <?php endif ?>

                </nav>
            </div>
        </div>

    <?php if ($sticky) : ?>
    </div>
    <?php endif ?>

<?php endif ?>

</div>
