<?php

use trk\theme\Theme;

foreach ($items as $item) {

    if ($item['type'] == 'header') {
        continue;
    }

    $attrs = ['class' => []];
    $title = $item['title'];

    // Parent?
    if ($item['hasChildren']) {
        $attrs['class'][] = 'uk-parent';
    }

    // Active?
    if ($item['active']) {
        $attrs['class'][] = 'uk-active';
    }

    // Icon
    $icon = $item['icon'];
    if (preg_match('/\.(gif|png|jpg|svg)$/i', $icon)) {
        $icon = "<img class=\"uk-responsive-height\" src=\"{$icon}\" alt=\"{$item->title}\">";
    } elseif ($icon) {
        $icon = "<span class=\"uk-margin-small-right\" uk-icon=\"icon: {$icon}\"></span>";
    }

    // Show Icon only
    if ($icon && $item['icon_only']) {
        $title = '';
    }

    $link = [];
    $link['href'] = $item->link;
    $link['target'] = $item['target'];
    $link['title'] = $item['anchor_title'];
    // Additional Class
    $link['class'] = $item['class'];

    if ($subtitle = $item['subtitle']) {
        $subtitle = "<div>{$subtitle}</div>";
    }

    echo "<li" . Theme::attrs($attrs) . "><a" . Theme::attrs($link) . ">{$icon}{$title}{$subtitle}</a></li>";
}
