<?php

use trk\theme\Theme;

foreach ($items as $item) {
    /**
     * @var $item \luya\cms\menu\Item
     **/
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
    if (preg_match('/\.(gif|png|jpg|svg)$/i', $icon)) {
        $icon = "<img class=\"uk-responsive-height\" src=\"{$icon}\" alt=\"{$item['title']}\">";
    } elseif ($icon) {
        $icon = "<span class=\"uk-margin-small-right\" uk-icon=\"icon: {$icon}\"></span>";
    }

    // Show Icon only
    if ($icon && $item['icon_only']) {
        $title = '';
    }

    // Header
    if ($item['type']) {

        $title = $icon.$title;

        // Divider
        if ($item['divider'] && !$children) {
            $title = '';
            $attrs['class'][] = 'uk-nav-divider';
        } elseif ($item['accordion'] && $children) {
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

        $title = "<a" . Theme::attrs($link) . ">{$icon}{$title}</a>";
    }

    // Children?
    if ($children) {

        $attrs['class'][] = 'uk-parent';

        $children = ['class' => []];

        if ($level == 1) {
            $children['class'][] = 'uk-nav-sub';
        }

        $children = "{$indention}<ul" . Theme::attrs($children) . ">\n" . Theme::view('templates/menu/nav', ['items' => $item['children'], 'level' => $level + 1]) . "</ul>";
    }

    echo "{$indention}<li" . Theme::attrs($attrs) . ">{$title}{$children}</li>";
}
