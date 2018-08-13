<?php

use trk\theme\Module;
use trk\uikit\helpers\ArrayHelper;

$header = Module::getConfig('header');

$class = [];
$badge = [];
$title = [];

$layout = $header['layout'];
$toggle = $position == 'navbar' && (strpos($layout, 'offcanvas') === 0 || $defaults['type'] == 'menu') || strpos($layout, 'modal') === 0;
$alignment = false;

if ($toggle) {
    $alignment = $index == 1 && strpos($layout, '-top-b') ? 'top' : '';
    $alignment = $index == 1 && strpos($layout, '-left-b') ? 'left' : $alignment;
    $alignment = $index == 0 && strpos($layout, '-center-b') ? 'vertical' : $alignment;
    $alignment = $alignment ? "uk-margin-auto-{$alignment}" : '';
}

// determine special positions
if ($position == 'debug' || $position == 'navbar' && $defaults['type'] == 'menu') {

    if ($alignment) {
        echo "<div class=\"{$alignment}\">";
    }

    echo $item['content'];

    if ($alignment) {
        echo '</div>';
    }

    return;
}

if ($position == 'navbar') {

    if ($defaults['type'] == 'search' && $header['search_style'] == 'modal' && preg_match('/^(horizontal|stacked)/', $layout)) {
        $itemClass = 'uk-navbar-toggle';
    } else {
        $itemClass = 'uk-navbar-item';
    }

    if ($toggle) {

        if ($alignment) {
            $class[] = $alignment;
        } else {
            $class[] = 'uk-margin-top';
        }

    } else if ($layout == 'stacked-left-b' && $index == 1) {
        $class[] = "uk-margin-auto-left {$itemClass}";
    } else {
        $class[] = $itemClass;
    }

} else if ($position == 'header' && preg_match('/^(offcanvas|modal|horizontal)/', $layout)) {

    $class[] = 'uk-navbar-item';

} else if (in_array($position, ['header', 'mobile', 'toolbar-right', 'toolbar-left'])) {

    $class[] = 'uk-panel';

} else {

    $class[] = $defaults['style'] ? "uk-card uk-card-body uk-{$defaults['style']}" : 'uk-panel';

}

// Class
if ($cls = (array) $defaults['class']) {
    $class = array_merge($class, $cls);
}

// Grid + sidebar positions
if (!preg_match('/^(toolbar-left|toolbar-right|navbar|header|debug)$/', $position)) {

    // Title?
    if ($defaults['show_title']) {

        $title['class'] = [];

        $title_element = $defaults['title_tag'];

        // Style?
        $title['class'][] = $defaults['title_style'] ? "uk-{$defaults['title_style']}" : '';
        $title['class'][] = $defaults['style'] && !$defaults['title_style'] ? "uk-card-title" : '';

        // Decoration?
        $title['class'][] = $defaults['title_decoration'] ? "uk-heading-{$defaults['title_decoration']}" : '';

    }

    // Text alignment
    if ($defaults['text_align'] && $defaults['text_align'] != 'justify' && $defaults['text_align_breakpoint']) {
        $class[] = "uk-text-{$defaults['text_align']}@{$defaults['text_align_breakpoint']}";
        if ($defaults['text_align_fallback']) {
            $class[] = "uk-text-{$defaults['text_align_fallback']}";
        }
    } else if ($defaults['text_align']) {
        $class[] = "uk-text-{$defaults['text_align']}";
    }

    // List
    if ($defaults['is_list']) {
        $class[] = "avb-child-list";

        // List Style?
        if ($defaults['list_style']) {
            $class[] = "avb-child-list-{$defaults['list_style']}";
        }

        // Link Style?
        if ($defaults['link_style']) {
            $class[] = "uk-link-{$defaults['link_style']}";
        }
    }

}

// Grid positions
if (preg_match('/^(top|bottom|builder-\d+)$/', $position)) {

    // Max Width?
    if ($defaults['maxwidth']) {
        $class[] = "uk-width-{$defaults['maxwidth']}";

        // Center?
        if ($defaults['maxwidth_align']) {
            $class[] = 'uk-margin-auto';
        }

    }

}
?>
<div<?= ArrayHelper::attrs(compact('class'), $defaults['attrs']) ?>>
    <?php if ($title) : ?>
        <<?= $title_element ?><?= ArrayHelper::attrs($title) ?>>
            <?php if ($defaults['title_decoration'] == 'line') : ?>
                <span><?= $item['title'] ?></span>
            <?php else: ?>
                <?= $item['title'] ?>
            <?php endif ?>
        </<?= $title_element ?>>
    <?php endif ?>
    <?= $item['content'] ?>
</div>
