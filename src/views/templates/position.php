<?php

use trk\theme\Module;
use trk\uikit\helpers\ArrayHelper;

/* @var $defaults Module::$defaults; */

$header = Module::getConfig('header');

// Blank
if (empty($style)) {

    if ($center = $name === 'navbar' && in_array($header['layout'], ['offcanvas-center-a', 'modal-center-a'])) {
        echo '<div class="uk-margin-auto-vertical">';
    }

    foreach ($items as $index => $item) {
        echo Module::render('templates/module', ['index' => $index, 'defaults' => $defaults, 'item' => $item, 'position' => $name]);
    }

    if ($center) {
        echo '</div>';
    }

    return;
}

// Cell
if ($style == 'cell') {

    foreach ($items as $index => $item) {
        echo '<div>' . Module::render('templates/module', ['index' => $index, 'defaults' => $defaults, 'item' => $item, 'position' => $name]) . '</div>';
    }

    return;
}

// Section
if ($style == 'section') {

    $section = [];

    foreach ($items as $index => $item) {

        if (preg_match('/<!-- (\{.*\}) -->/si', $item['content'], $matches)) {

            if ($section) {
                echo Module::render('templates/section', ['name' => $name, 'items' => $section]);
                $section = [];
            }

            echo preg_replace('/<div class="uk-text-danger(.*?)<\/div>/si', '', $item['content']);

        } else {
            $section[] = $item;
        }
    }

    if ($section) {
        echo Module::render('templates/section', ['name' => $name, 'items' => $section]);
    }

    return;
}

// Grid
$position = isset($element) ? $element : Module::getConfig($name);
$attrs = ['class' => [], 'uk-grid' => true];
$visibilities = ['xs', 's', 'm', 'l', 'xl'];
$visible = 4;

if ($style == 'grid-stack') {
    $attrs['class'][] = 'uk-child-width-1-1';
} else {
    $attrs['class'][] = "uk-child-width-expand@{$position['breakpoint']}";
}

$attrs['class'][] = $position['grid_gutter'] ? "uk-grid-{$position['grid_gutter']}" : '';
$attrs['class'][] = $position['grid_divider'] ? 'uk-grid-divider' : '';
$attrs['class'][] = $position['match'] & !$position['vertical_align'] ? 'uk-grid-match' : '';
$attrs['class'][] = $position['vertical_align'] ? 'uk-flex-middle' : '';


// Widgets/Modules
foreach ($items as $index => $item) {

    $item['cell'] = [];

    if ($width = $configs['width']) {
        $item['cell'][] = "uk-width-{$width}@{$position['breakpoint']}";
    }

    if ($visibility = $item->config['visibility']) {
        $item['cell'][] = "uk-visible@{$visibility}";
    }

    $visible = min(array_search($visibility, $visibilities), $visible);

    $item['content'] = Module::render('module', ['index' => $index, 'defaults' => $defaults, 'item' => $item, 'position' => $name]);
}

if ($visible) {
    $attrs['class'][] = "uk-visible@{$visibilities[$visible]}";
}
?>
<div<?= ArrayHelper::attrs($attrs) ?>>
    <?php foreach ($items as $item) : ?>
        <div<?= ArrayHelper::attrs(['class' => $item['cell']]) ?>><?= $item['content'] ?></div>
    <?php endforeach ?>
</div>
