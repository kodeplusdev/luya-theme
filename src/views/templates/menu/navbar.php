<?php

use trk\theme\Module;
use trk\uikit\helpers\ArrayHelper;

$level = isset($level) ? $level : 1;

$navbar = Module::getConfig('navbar');

// foreach ($items as $item) {
foreach (array_values($items) as $i => $item) {
    $attrs = ['class' => []];
    $children = $item['hasChildren'];
    $indention = str_pad("\n", $level + 1, "\t");
    $title = $item['title'];

    // Active?
    if ($item['active']) {
        $attrs['class'][] = 'uk-active';
    }

    // Icon
    $icon = $item['icon'];
    $icon_attrs['class'][] = $item['image_class'];
    if (preg_match('/\.(gif|png|jpg|svg)$/i', $icon)) {
        $icon_attrs['class'][] = 'uk-responsive-height uk-margin-small-right';
        $icon = "<img " . ArrayHelper::attrs($icon_attrs) . " src=\"{$icon}\" alt=\"{$item['title']}\">";
    } elseif ($icon) {
        $icon_attrs['class'][] = 'uk-margin-small-right';
        $icon = "<span " . ArrayHelper::attrs($icon_attrs) . " data-uk-icon=\"icon: {$icon}\"></span>";
    }

    // Show Icon only
    if ($icon && $item['icon_only']) {
        $title = '';
    }

    // Header
    if ($item['type']) {

        if (!$children && $level == 1) {
            continue;
        }

        $title = $icon.$title;

        if ($level > 1 && $item['divider'] && !$children) {
            $title = '';
            $attrs['class'][] = 'uk-nav-divider';
        } elseif (isset($accordion) && $accordion && $children) {
            $title = "<a href=\"#\">{$title}</a>";
        } else {
            $attrs['class'][] = 'uk-nav-header';
        }

    // Link
    } else {

        $link = [];
        $link['href'] = $item['link'];
        $link['target'] = $item['target'];
        $link['title'] = $item['anchor_title'];
        // Additional Class
        $link['class'] = $item['class'];

        if ($title && $subtitle = $level == 1 ? $item['subtitle'] : '') {
            $title = "<div>{$title}<div class=\"uk-navbar-subtitle\">{$subtitle}</div></div>";
        }

        $title = "<a" . ArrayHelper::attrs($link) . ">{$icon}{$title}</a>";
    }

    // Children?
    if ($children) {

        $children = ['class' => []];
        $attrs['class'][] = 'uk-parent';

        if ($level == 1) {

            $parts = array_chunk($item['children'], ceil(count($item['children']) / $item['columns']));
            $count = count($parts);

            $children['class'][] = 'uk-navbar-dropdown';

            $click = $item['type'] === 'header' && $mode = $navbar['dropdown_click'];

            if ($justify = $item['justify'] or $click) {

                $boundary = $justify || $navbar['dropbar'] && $navbar['dropdown_boundary'];

                $children['uk-drop'] = json_encode(array_filter([
                    'clsDrop' => 'uk-navbar-dropdown',
                    'flip' => 'x',
                    'pos' => $justify ? 'bottom-justify' : 'bottom-' . $navbar['dropdown_align'],
                    'boundary' => $boundary ? '!nav' : false,
                    'boundaryAlign' => $boundary,
                    'mode' => $click ? 'click' : 'click,hover'
                ]));
            }

            $columns = '';
            foreach ($parts as $part) {
                $columns .= "<div><ul class=\"uk-nav uk-navbar-dropdown-nav\">\n" . Module::render('templates/menu/navbar', ['items' => $part, 'level' => $level + 1]) . "</ul></div>";
            }
            // $columns .= "<div><ul class=\"uk-nav uk-navbar-dropdown-nav\">\n" . Module::render('templates/menu/navbar', ['items' => $parts, 'level' => $level + 1]) . "</ul></div>";
            $wrapper = ['class' => ['uk-navbar-dropdown-grid'], 'uk-grid' => true];

            if ($count > 1 && !$justify) {
                $children['class'][] = "uk-navbar-dropdown-width-{$count}";
            }

            $wrapper['class'][] = "uk-child-width-1-{$count}";

            $children = "{$indention}<div" . ArrayHelper::attrs($children) . "><div" . ArrayHelper::attrs($wrapper) . ">{$columns}</div></div>";

        } else {

            if ($level == 2) {
                $children['class'][] = 'uk-nav-sub';
            }

            $children = "{$indention}<ul" . ArrayHelper::attrs($children) . ">\n" . Module::render('templates/menu/navbar', ['items' => $item['children'], 'level' => $level + 1]) . "</ul>";
        }
    }

    echo "{$indention}<li" . ArrayHelper::attrs($attrs) . ">{$title}{$children}</li>";
}
