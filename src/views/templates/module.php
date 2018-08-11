<?php

use trk\theme\Theme;

$header = Theme::get('header');

$class = [];
$badge = [];
$title = [];

$layout = $header['layout'];
$toggle = $position == 'navbar' && (strpos($layout, 'offcanvas') === 0 || $configs['type'] == 'menu') || strpos($layout, 'modal') === 0;
$alignment = false;

if ($toggle) {
    $alignment = $index == 1 && strpos($layout, '-top-b') ? 'top' : '';
    $alignment = $index == 1 && strpos($layout, '-left-b') ? 'left' : $alignment;
    $alignment = $index == 0 && strpos($layout, '-center-b') ? 'vertical' : $alignment;
    $alignment = $alignment ? "uk-margin-auto-{$alignment}" : '';
}

// determine special positions
if ($position == 'debug' || $position == 'navbar' && $configs['type'] == 'menu') {

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

    if ($configs['type'] == 'search' && $header['search_style'] == 'modal' && preg_match('/^(horizontal|stacked)/', $layout)) {
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

    $class[] = $configs['style'] ? "uk-card uk-card-body uk-{$configs['style']}" : 'uk-panel';

}

// Class
if ($cls = (array) $configs['class']) {
    $class = array_merge($class, $cls);
}

// Grid + sidebar positions
if (!preg_match('/^(toolbar-left|toolbar-right|navbar|header|debug)$/', $position)) {

    // Title?
    if ($configs['show_title']) {

        $title['class'] = [];

        $title_element = $configs['title_tag'];

        // Style?
        $title['class'][] = $configs['title_style'] ? "uk-{$configs['title_style']}" : '';
        $title['class'][] = $configs['style'] && !$configs['title_style'] ? "uk-card-title" : '';

        // Decoration?
        $title['class'][] = $configs['title_decoration'] ? "uk-heading-{$configs['title_decoration']}" : '';

    }

    // Text alignment
    if ($configs['text_align'] && $configs['text_align'] != 'justify' && $configs['text_align_breakpoint']) {
        $class[] = "uk-text-{$configs['text_align']}@{$configs['text_align_breakpoint']}";
        if ($configs['text_align_fallback']) {
            $class[] = "uk-text-{$configs['text_align_fallback']}";
        }
    } else if ($configs['text_align']) {
        $class[] = "uk-text-{$configs['text_align']}";
    }

    // List
    if ($configs['is_list']) {
        $class[] = "avb-child-list";

        // List Style?
        if ($configs['list_style']) {
            $class[] = "avb-child-list-{$configs['list_style']}";
        }

        // Link Style?
        if ($configs['link_style']) {
            $class[] = "uk-link-{$configs['link_style']}";
        }
    }

}

// Grid positions
if (preg_match('/^(top|bottom|builder-\d+)$/', $position)) {

    // Max Width?
    if ($configs['maxwidth']) {
        $class[] = "uk-width-{$configs['maxwidth']}";

        // Center?
        if ($configs['maxwidth_align']) {
            $class[] = 'uk-margin-auto';
        }

    }

}

?>

<div<?= Theme::attrs(compact('class'), $configs['attrs']) ?>>

    <?php if ($title) : ?>
    <<?= $title_element ?><?= Theme::attrs($title) ?>>

        <?php if ($configs['title_decoration'] == 'line') : ?>
            <span><?= $item['title'] ?></span>
        <?php else: ?>
            <?= $item['title'] ?>
        <?php endif ?>

    </<?= $title_element ?>>
    <?php endif ?>

    <?= $item['content'] ?>

</div>
